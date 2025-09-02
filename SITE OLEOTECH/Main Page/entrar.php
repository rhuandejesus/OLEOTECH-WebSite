<?php
session_start();

// Redireciona se o usuário já estiver logado
if (isset($_SESSION['tipo_usuario'])) {
    if ($_SESSION['tipo_usuario'] === 'cliente') {
        header('Location: ../Historico/Clientes/coletas_clientes.php');
        exit();
    } elseif ($_SESSION['tipo_usuario'] === 'empresa') {
        header('Location: ../Historico/Empresa/coletas_empresa.php');
        exit();
    }
}

// Se não estiver logado, manda para o login direto
header('Location: login.php');
exit();

