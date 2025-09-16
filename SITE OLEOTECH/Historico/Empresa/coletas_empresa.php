<?php
session_start();
include(__DIR__ . '/../../Login/config.php');

if (!isset($_SESSION['usuario_id'])) {
    header('location: ../../Login/login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$tipo_usuario = $_SESSION['tipo_usuario'];

// Apenas empresas acessam esta página
if ($tipo_usuario !== 'empresa') {
    header('location: ../../Login/login.php');
    exit();
}

// CSRF token simples
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Tratamento de exclusão (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $msg = ['success' => null, 'error' => null];

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        $msg['error'] = 'Token inválido. Tente novamente.';
    } else {
        $id_coleta = intval($_POST['id_coleta'] ?? 0);
        if ($id_coleta > 0) {
            $stmt = $conexao->prepare("DELETE FROM tb_coletas WHERE id_coleta = ? AND idEmpresa = ?");
            $stmt->bind_param('ii', $id_coleta, $usuario_id);
            if ($stmt->execute()) {
                $msg['success'] = 'Coleta removida com sucesso.';
            } else {
                $msg['error'] = 'Erro ao remover a coleta.';
            }
            $stmt->close();
        } else {
            $msg['error'] = 'ID inválido.';
        }
    }

    $_SESSION['flash'] = $msg;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Busca histórico de coletas da empresa, incluindo o nome do coletor
$sql = "SELECT c.id_coleta, c.data, c.quantidade, cl.nome AS cliente_nome, col.nome AS coletor_nome
        FROM tb_coletas c
        JOIN tb_clientes cl ON c.idCliente = cl.id_cliente
        JOIN tb_coletores col ON c.idColetor = col.id_coletor
        WHERE c.idEmpresa = {$usuario_id}
        ORDER BY c.data DESC";

$res = $conexao->query($sql);

// Flash messages
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Histórico de Coletas - Empresa OLEOTECH</title>
    <link rel="stylesheet" href="../../Login/Login.css">
    <link class="iconSite" rel="icon" type="image/png" href="../../img/gota__1_-removebg-preview.png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }

        h2 {
            color: #1B63C5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1B63C5;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .botao {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 15px;
            background: #1B63C5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .botao:hover {
            background: #0553a3;
        }

        .flash-success {
            background: #e6ffed;
            border: 1px solid #b7f0c9;
            padding: 8px;
            color: #0a7a3c;
            margin-bottom: 8px;
        }

        .flash-error {
            background: #ffecec;
            border: 1px solid #f5c2c2;
            padding: 8px;
            color: #a12b2b;
            margin-bottom: 8px;
        }

        form.delete-form {
            display: inline-block;
            margin-left: 5px;
        }
    </style>
</head>

<body>

    <h2>Histórico de Coletas da Empresa</h2>

    <?php if (!empty($flash['success'])): ?>
        <div class="flash-success"><?php echo htmlspecialchars($flash['success']); ?></div>
    <?php endif; ?>
    <?php if (!empty($flash['error'])): ?>
        <div class="flash-error"><?php echo htmlspecialchars($flash['error']); ?></div>
    <?php endif; ?>

    <a href="../../Main Page/index.html" class="botao">Sair</a>
    <a href="../Empresa/Coletor/cadastro_coletor.php" class="botao">Cadastrar Coletor</a>
    <a href="../Empresa/Coletor/coletores_empresa.php" class="botao">Coletores</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Quantidade</th>
                <th>Cliente</th>
                <th>Coletor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($res && $res->num_rows > 0) : ?>
                <?php while ($row = $res->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id_coleta'] ?></td>
                        <td><?= date('d/m/Y', strtotime($row['data'])) ?></td>
                        <td><?= $row['quantidade'] ?></td>
                        <td><?= htmlspecialchars($row['cliente_nome']) ?></td>
                        <td><?= htmlspecialchars($row['coletor_nome']) ?></td>
                        <td>
                            <form method="post" class="delete-form" onsubmit="return confirm('Tem certeza que deseja remover esta coleta?');">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <input type="hidden" name="id_coleta" value="<?= $row['id_coleta'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="botao">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhuma coleta encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>