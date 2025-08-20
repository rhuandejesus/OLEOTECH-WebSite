<?php
// Inicia a sessão para poder manipulá-la
session_start();

// Destrói todas as variáveis de sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona o usuário para a página de login
header('Location: login.php');
exit();
?>