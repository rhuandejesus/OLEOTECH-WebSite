<?php
session_start();

// Verifica se a sessão 'autenticado' está definida e é 'sim'
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'sim') {
    header('Location: login.php');
    exit();
}

// O restante do HTML da página continua abaixo
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Coletor</title>
</head>
<body>
    <h1>Bem-vindo, Coletor!</h1>
    <p>Olá, <?php echo $_SESSION['nome']; ?>. Por enquanto isso é tudo que tem.</p>
    <a href="logout.php">Sair</a>
</body>
</html>