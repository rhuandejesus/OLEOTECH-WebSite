<?php
session_start();

// Ajuste o caminho para o config.php conforme sua estrutura de pastas
include_once('../../../Login/config.php');

// Checa se a conexão existe
if (!$conn) {
    die("Erro: conexão com o banco de dados não foi estabelecida.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $senha = md5($_POST['senha']); // criptografia básica
    $idEmpresa = $_POST['empresa_id']; // vindo do hidden do formulário

    // Verifica se o coletor já existe pelo CPF ou e-mail
    $check = mysqli_query($conn, "SELECT * FROM tb_coletores WHERE cpf='$cpf' OR email='$email'");
    if(mysqli_num_rows($check) > 0) {
        echo "<script>alert('Coletor já cadastrado!'); window.history.back();</script>";
        exit;
    }

    // Inserir no banco
    $sql = "INSERT INTO tb_coletores (nome, email, senha, idEmpresa) 
            VALUES ('$nome', '$email', '$senha', '$idEmpresa')";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Coletor cadastrado com sucesso!'); window.location.href='historico_empresa.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar coletor: ".mysqli_error($conn)."'); window.history.back();</script>";
    }
}
?>

