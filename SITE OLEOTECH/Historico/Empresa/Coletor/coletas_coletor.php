<?php
session_start();
include('../../../Login/config.php');

if (!isset($_SESSION['usuario_id']) || ($_SESSION['tipo_usuario'] ?? '') !== 'coletor') {
    header('location: ../../Login/login.php');
    exit();
}

$idColetor = $_SESSION['usuario_id'];

// -----------------------------
// Endpoint AJAX de busca (mesmo arquivo)
// Uso: coletas_coletor.php?action=buscar&q=TERMO
// -----------------------------
if (isset($_GET['action']) && $_GET['action'] === 'buscar') {
    header('Content-Type: application/json; charset=utf-8');
    $termo = trim($_GET['q'] ?? '');
    $saida = [];

    if ($termo !== '') {
        // Prepared statement para segurança
        $sql = "SELECT id_cliente, nome, cpf FROM tb_clientes WHERE nome LIKE ? OR cpf LIKE ? LIMIT 10";
        if ($stmt = $conexao->prepare($sql)) {
            $like = '%' . $termo . '%';
            $stmt->bind_param('ss', $like, $like);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_assoc()) {
                // enviamos apenas os campos necessários
                $saida[] = [
                    'id_cliente' => $row['id_cliente'],
                    'nome' => $row['nome'],
                    'cpf' => $row['cpf']
                ];
            }
            $stmt->close();
        }
    }

    echo json_encode($saida);
    exit();
}

// ==========================================
// Atualizar coleta existente
// ==========================================
if (isset($_POST['id_coleta'], $_POST['nova_quantidade'])) {
    $id_coleta = (int) $_POST['id_coleta'];
    $nova_quantidade = (float) $_POST['nova_quantidade'];

    $sql_update = "UPDATE tb_coletas 
                   SET quantidade = ? 
                   WHERE id_coleta = ? AND idColetor = ?";
    if ($stmt = $conexao->prepare($sql_update)) {
        $stmt->bind_param('dii', $nova_quantidade, $id_coleta, $idColetor);
        $stmt->execute();
        $stmt->close();
    }

    // Redireciona para evitar reenvio do form
    header("Location: coletas_coletor.php");
    exit();
}

// ==========================================
// Registrar nova coleta
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idCliente'], $_POST['quantidade'])) {
    $idCliente = (int) $_POST['idCliente'];
    $quantidade = (float) $_POST['quantidade'];
    $data = date('Y-m-d H:i:s');

    // Busca a empresa do coletor
    $res_empresa = $conexao->query("SELECT idEmpresa FROM tb_coletores WHERE id_coletor = $idColetor");
    $idEmpresa = $res_empresa->fetch_assoc()['idEmpresa'] ?? null;

    $sql_insert = "INSERT INTO tb_coletas (data, quantidade, idCliente, idColetor, idEmpresa)
                   VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conexao->prepare($sql_insert)) {
        $stmt->bind_param('sdiis', $data, $quantidade, $idCliente, $idColetor, $idEmpresa);
        // note: idEmpresa pode ser null; se for INT no DB, ajustar conforme necessário
        $stmt->execute();
        $stmt->close();
    }
}

// Pega lista de clientes (mantive a query como você tinha; não é utilizada pelo autocomplete,
// mas deixei para compatibilidade)
$res_clientes = $conexao->query("SELECT id_cliente, nome, cpf FROM tb_clientes");

// Pega histórico de coletas do coletor
$res_hist = $conexao->query("
    SELECT c.id_coleta, c.quantidade, c.data, cl.nome AS cliente_nome
    FROM tb_coletas c
    JOIN tb_clientes cl ON c.idCliente = cl.id_cliente
    WHERE c.idColetor = $idColetor
    ORDER BY c.data DESC
");

// ==========================================
// Exclui a coleta
// ==========================================
if (isset($_POST['excluir_id_coleta'])) {
    $excluir_id_coleta = (int) $_POST['excluir_id_coleta'];

    // Somente permite excluir se o coletor for o dono da coleta
    $sql_delete = "DELETE FROM tb_coletas 
                   WHERE id_coleta = ? AND idColetor = ?";
    if ($stmt = $conexao->prepare($sql_delete)) {
        $stmt->bind_param('ii', $excluir_id_coleta, $idColetor);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: coletas_coletor.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coletas - Coletor</title>
    <link rel="stylesheet" href="../../../Login/Login.css">
    <link class="iconSite" rel="icon" type="image/png" href="../../../img/gota__1_-removebg-preview.png">
    <style>
        /* Mantive seu estilo original e adicionei só o necessário para o autocomplete */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #82B3F4 0%, #FFFFFF 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 30, 87, 0.15);
            padding: 30px;
        }

        h2 {
            margin-top: 0;
            color: #1B63C5;
            text-align: center;
        }

        .tabela-input {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
            position: relative;
        }

        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 10px 15px;
            width: 100%;
            box-sizing: border-box;
            position: relative; /* necessário para a dropdown */
            background: #fff;
        }

        .input-group input,
        .input-group select {
            border: none;
            outline: none;
            width: 100%;
            font-size: 1em;
        }

        .login-button {
            background: #086BEC;
            color: #fff;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 1em;
            cursor: pointer;
            width: 40%;
            margin: 0 auto;
            display: block;
        }

        .login-button:hover {
            background-color: #0651a8;
        }

        /* Autocomplete result box */
        .resultado-busca {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-height: 240px;
            overflow-y: auto;
            z-index: 2000;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .resultado-busca .item {
            padding: 10px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.95rem;
        }

        .resultado-busca .item:last-child {
            border-bottom: none;
        }

        .resultado-busca .item:hover {
            background: #f7f9ff;
        }

        .cpf-display {
            font-size: 0.9rem;
            color: #333;
            margin-top: 6px;
            margin-left: 4px;
        }

        /* Tabela estilizada */
        table {
            width: 90%;
            margin: 0 auto 20px auto;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #1B63C5;
            color: #fff;
            font-weight: 600;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Botão voltar */
        .botao-voltar {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 190px;
            height: 56px;
            border-radius: 16px;
            background: #fff;
            font-size: 18px;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            overflow: hidden;
            cursor: pointer;
            margin-top: 20px;
        }

        .botao-voltar p {
            position: relative;
            z-index: 2;
            margin-left: 8px;
            transition: color 0.3s;
        }

        .botao-voltar .icon-area {
            position: absolute;
            left: 4px;
            top: 4px;
            width: 48px;
            height: 48px;
            background: #1B63C5;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: width 0.5s ease;
            z-index: 1;
            color: #fff;
            font-size: 24px;
        }

        .botao-voltar:hover .icon-area {
            width: 182px;
        }

        .botao-voltar:hover p {
            display: none;
        }

        /* Responsividade */
        @media (max-width: 1024px) {
            .login-container {
                width: 80%;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
                padding: 5%;
            }

            .login-container {
                width: 100%;
                box-shadow: none;
            }
        }

        @media (max-width: 480px) {
            .login-button {
                width: 80%;
                font-size: 0.9em;
                padding: 10px;
            }

            table th,
            table td {
                padding: 8px;
                font-size: 0.85em;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">

        <h2>Registrar Coleta</h2>

        <form method="POST" class="tabela-input" id="formRegistrar">
            <div class="input-group" style="position:relative;">
                <!-- campo de busca digitável -->
                <input type="text" id="buscaCliente" placeholder="Digite nome completo ou CPF do cliente" autocomplete="off" aria-label="Buscar cliente">
                <input type="hidden" name="idCliente" id="idCliente" required>
                <div id="resultadoBusca" class="resultado-busca" style="display:none;"></div>
            </div>

            <!-- exibe CPF do cliente selecionado -->
            <div class="cpf-display" id="cpfDisplay" style="display:none;">CPF: <span id="cpfText"></span></div>

            <div class="input-group">
                <input type="number" name="quantidade" placeholder="Quantidade (ml)" step="0.01" required>
            </div>
            <button type="submit" class="login-button">Registrar</button>
        </form>

        <h2>Histórico de Coletas</h2>
        <table border="1" cellpadding="5" style="width: 90%; margin: 0 auto; border-collapse: collapse;">
            <tr>
                <th>Cliente</th>
                <th>Quantidade (ml)</th>
                <th>Data</th>
            </tr>
            <?php
            $sql_hist = "SELECT c.quantidade, c.data, cl.nome AS cliente_nome
                     FROM tb_coletas c
                     JOIN tb_clientes cl ON c.idCliente = cl.id_cliente
                     WHERE c.idColetor = $idColetor
                     ORDER BY c.data DESC";
            $res_hist = $conexao->query($sql_hist);
            if ($res_hist) {
                while ($row = $res_hist->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['cliente_nome']) . "</td>
                        <td>" . htmlspecialchars($row['quantidade']) . "</td>
                        <td>" . htmlspecialchars($row['data']) . "</td>
                      </tr>";
                }
            }
            ?>
        </table>

        <a href="../../Empresa/coletas_empresa.php" class="botao-voltar">
            <div class="icon-area">&#8592;</div>
            <p>Voltar</p>
        </a>

        <h2>Atualizar Coleta</h2>
        <table border="1" cellpadding="5" style="width: 90%; margin: 0 auto; border-collapse: collapse;">
            <tr>
                <th>Cliente</th>
                <th>Quantidade (ml)</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
            <?php
            $sql_hist_update = "SELECT c.id_coleta, c.quantidade, c.data, cl.nome AS cliente_nome
            FROM tb_coletas c
            JOIN tb_clientes cl ON c.idCliente = cl.id_cliente
            WHERE c.idColetor = $idColetor
            ORDER BY c.data DESC";
            $res_hist_update = $conexao->query($sql_hist_update);
            if ($res_hist_update) {
                while ($row = $res_hist_update->fetch_assoc()) {
                    echo "<tr>
                <td>" . htmlspecialchars($row['cliente_nome']) . "</td>
                <td>
                    <form method='POST' style='display:flex; justify-content:center; gap:5px;'>
                        <input type='hidden' name='id_coleta' value='" . htmlspecialchars($row['id_coleta']) . "'>
                        <input type='number' name='nova_quantidade' value='" . htmlspecialchars($row['quantidade']) . "' step='0.01' required>
                        <button type='submit' class='login-button'>Atualizar</button>
                    </form>
                </td>
                <td>" . htmlspecialchars($row['data']) . "</td>
                <td>
                    <form method='POST' style='margin:0;'>
                        <input type='hidden' name='excluir_id_coleta' value='" . htmlspecialchars($row['id_coleta']) . "'>
                        <button type='submit' style='background:#e74c3c;color:#fff;border:none;border-radius:5px;padding:5px 10px;cursor:pointer;'>Excluir</button>
                    </form>
                </td>
                </tr>";
                }
            }
            ?>
        </table>

    </div>

    <script>
        // debounce util
        function debounce(fn, delay) {
            let t;
            return function (...args) {
                clearTimeout(t);
                t = setTimeout(() => fn.apply(this, args), delay);
            }
        }

        const buscaInput = document.getElementById('buscaCliente');
        const resultadoDiv = document.getElementById('resultadoBusca');
        const idClienteInput = document.getElementById('idCliente');
        const cpfDisplay = document.getElementById('cpfDisplay');
        const cpfText = document.getElementById('cpfText');
        const formRegistrar = document.getElementById('formRegistrar');

        // busca no servidor
        async function buscarClientes(term) {
            if (!term || term.trim().length < 2) {
                resultadoDiv.style.display = 'none';
                resultadoDiv.innerHTML = '';
                return;
            }

            try {
                const resp = await fetch('?action=buscar&q=' + encodeURIComponent(term));
                if (!resp.ok) throw new Error('Erro na busca');
                const data = await resp.json();

                resultadoDiv.innerHTML = '';
                if (data.length === 0) {
                    resultadoDiv.innerHTML = '<div class="item">Nenhum resultado</div>';
                } else {
                    data.forEach(c => {
                        const item = document.createElement('div');
                        item.className = 'item';
                        // mostrar nome (negrito) e cpf
                        item.innerHTML = `<strong>${escapeHtml(c.nome)}</strong><br><small>CPF: ${escapeHtml(c.cpf)}</small>`;
                        item.addEventListener('click', () => {
                            buscaInput.value = c.nome;
                            idClienteInput.value = c.id_cliente;
                            cpfText.textContent = c.cpf;
                            cpfDisplay.style.display = 'block';
                            resultadoDiv.style.display = 'none';
                            resultadoDiv.innerHTML = '';
                        });
                        resultadoDiv.appendChild(item);
                    });
                }
                resultadoDiv.style.display = 'block';
            } catch (err) {
                console.error(err);
                resultadoDiv.style.display = 'none';
            }
        }

        const buscarDebounced = debounce((e) => {
            // limpa idCliente ao digitar para evitar submissão com id incorreto
            idClienteInput.value = '';
            cpfDisplay.style.display = 'none';
            cpfText.textContent = '';
            buscarClientes(e.target.value);
        }, 300);

        buscaInput.addEventListener('input', buscarDebounced);

        // fechar se clicar fora
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.input-group')) {
                resultadoDiv.style.display = 'none';
            }
        });

        // impedir submit se não selecionou cliente válido
        formRegistrar.addEventListener('submit', (e) => {
            if (!idClienteInput.value) {
                e.preventDefault();
                alert('Selecione um cliente válido a partir da lista (digite nome ou CPF e escolha).');
                buscaInput.focus();
            }
        });

        // helper para escapar HTML
        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    </script>
</body>

</html>
