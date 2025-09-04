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

// Busca histórico de coletas da empresa
$sql = "SELECT c.id_coleta, c.data, c.quantidade, cl.nome AS cliente_nome
        FROM tb_coletas c
        JOIN tb_clientes cl ON c.idCliente = cl.id_cliente
        WHERE c.idEmpresa = {$usuario_id}
        ORDER BY c.data DESC";

$res = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Histórico de Coletas - Empresa OLEOTECH</title>
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

        .botao {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 15px;
            background: #1B63C5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .voltar:hover {
            background: #0553a3;
        }
    </style>
</head>

<body>

    <h2>Histórico de Coletas da Empresa</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Quantidade</th>
                <th>Cliente</th>
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
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhuma coleta encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="../../Main Page/index.html" class="botao">Sair</a>
    <a href="../Empresa/Coletor/cadastro_coletor.php" class="botao">Cadastrar Coletor</a>

</body>

</html>
