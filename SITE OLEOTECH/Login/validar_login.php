<?php
session_start();
require 'config.php';

// Limpando os dados do formulário
$emailUsuario = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senhaUsuario = md5(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));

// Verificação de segurança para evitar consultas vazias
if (empty($emailUsuario) || empty($senhaUsuario)) {
    header('location: login.php?login=erro');
    exit();
}

// Usando prepared statements para evitar injeção de SQL
// CORREÇÃO: A coluna 'id_usuario' foi alterada para 'id_usuarios'
$stmt = $conexao->prepare("SELECT id_usuarios, perfil, nome, senha FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $emailUsuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if ($usuario && $senhaUsuario === $usuario['senha']) {
    // Autenticação bem-sucedida
    $_SESSION['autenticado'] = 'sim';
    // CORREÇÃO: A chave da sessão 'id' usa a coluna 'id_usuarios'
    $_SESSION['id'] = $usuario['id_usuarios'];
    $_SESSION['perfil'] = $usuario['perfil'];
    $_SESSION['nome'] = $usuario['nome'];

    if ($_SESSION['perfil'] === 'Fornecedor') { // A imagem mostra 'Fornecedor' com F maiúsculo
        header('location: fornecedor.php');
        exit();
    } else if ($_SESSION['perfil'] === 'Coletor') { // Certifique-se de que o perfil no BD é 'Coletor' com C maiúsculo
        header('location: coletor.php');
        exit();
    } else {
        header('location: home.php');
        exit();
    }
} else {
    // Autenticação falhou
    $_SESSION['autenticado'] = 'nao';
    header('location: login.php?login=erro');
    exit();
}

$stmt->close();
$conexao->close();
?>