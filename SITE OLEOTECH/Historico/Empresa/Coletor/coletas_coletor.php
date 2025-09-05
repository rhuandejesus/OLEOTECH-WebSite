<?php
session_start();
include('../../../Login/config.php');

if (!isset($_SESSION['usuario_id']) || ($_SESSION['tipo_usuario'] ?? '') !== 'coletor') {
    header('location: ../../Login/login.php');
    exit();
}

$idColetor = $_SESSION['usuario_id'];

// ==========================================
// Atualizar coleta existente
// ==========================================
if (isset($_POST['id_coleta'], $_POST['nova_quantidade'])) {
    $id_coleta = (int) $_POST['id_coleta'];
    $nova_quantidade = (float) $_POST['nova_quantidade'];

    $sql_update = "UPDATE tb_coletas 
                   SET quantidade = $nova_quantidade 
                   WHERE id_coleta = $id_coleta AND idColetor = $idColetor";
    $conexao->query($sql_update);

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
    $idEmpresa = $res_empresa->fetch_assoc()['idEmpresa'];

    $sql_insert = "INSERT INTO tb_coletas (data, quantidade, idCliente, idColetor, idEmpresa)
                   VALUES ('$data', $quantidade, $idCliente, $idColetor, $idEmpresa)";
    $conexao->query($sql_insert);
}

// Pega lista de clientes da mesma empresa
$res_clientes = $conexao->query("SELECT * FROM tb_clientes");

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
                   WHERE id_coleta = $excluir_id_coleta AND idColetor = $idColetor";
    $conexao->query($sql_delete);

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
</head>

<style>
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
        max-width: 600px;
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
    }

    .input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 15px;
        padding: 10px 15px;
        width: 100%;
        box-sizing: border-box;
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

<body>
    <div class="login-container">

        <h2>Registrar Coleta</h2>

        <form method="POST" class="tabela-input">
            <div class="input-group">
                <select name="idCliente" required>
                    <option value="">Selecione o cliente</option>
                    <?php while ($cliente = $res_clientes->fetch_assoc()): ?>
                        <option value="<?= $cliente['id_cliente'] ?>">
                            <?= htmlspecialchars($cliente['nome']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
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
                        <td>" . $row['quantidade'] . "</td>
                        <td>" . $row['data'] . "</td>
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
                        <input type='hidden' name='id_coleta' value='" . $row['id_coleta'] . "'>
                        <input type='number' name='nova_quantidade' value='" . $row['quantidade'] . "' step='0.01' required>
                        <button type='submit' class='login-button'>Atualizar</button>
                    </form>
                </td>
                <td>" . $row['data'] . "</td>
                <td>
                    <form method='POST' style='margin:0;'>
                        <input type='hidden' name='excluir_id_coleta' value='" . $row['id_coleta'] . "'>
                        <button type='submit' style='background:#e74c3c;color:#fff;border:none;border-radius:5px;padding:5px 10px;cursor:pointer;'>Excluir</button>
                    </form>
                </td>
                </tr>";
                }
            }
            ?>
        </table>



    </div>
</body>

</html>