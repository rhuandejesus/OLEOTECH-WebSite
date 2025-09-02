<?php
session_start();
include(__DIR__ . '/../../Login/config.php');

if (!isset($_SESSION['usuario_id'])) {
    header('location: login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$tipo_usuario = $_SESSION['tipo_usuario'];

// Busca histórico do cliente
if ($tipo_usuario === 'cliente') {
    $sql = "SELECT c.id_coleta, c.data, c.quantidade, e.nome AS empresa_nome
            FROM tb_coletas c
            JOIN tb_empresas e ON c.idEmpresa = e.id_empresa
            WHERE c.idCliente = {$usuario_id}
            ORDER BY c.data DESC";
} else {
    $sql = "SELECT c.id_coleta, c.data, c.quantidade, cl.nome AS cliente_nome
            FROM tb_coletas c
            JOIN tb_clientes cl ON c.idCliente = cl.id_cliente
            WHERE c.idEmpresa = {$usuario_id}
            ORDER BY c.data DESC";
}

$res = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Histórico de Coletas - OLEOTECH</title>
    <link rel="stylesheet" href="../../Login/Login.css">
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

        .voltar {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 15px;
            background: #1B63C5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .voltar:hover {
            background: #1B63C5;
        }
    </style>
</head>

<body>

    <h2>Histórico de Coletas do Usuário</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Quantidade</th>
                <?php if ($tipo_usuario === 'cliente') : ?>
                    <th>Empresa</th>
                <?php else: ?>
                    <th>Cliente</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if ($res && $res->num_rows > 0) : ?>
                <?php while ($row = $res->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id_coleta'] ?></td>
                        <td><?= date('d/m/Y', strtotime($row['data'])) ?></td>
                        <td><?= $row['quantidade'] ?></td>
                        <?php if ($tipo_usuario === 'cliente') : ?>
                            <td><?= htmlspecialchars($row['empresa_nome']) ?></td>
                        <?php else: ?>
                            <td><?= htmlspecialchars($row['cliente_nome']) ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhuma coleta encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="../../Main Page/index.html" class="voltar">Sair</a>

</body>

</html>