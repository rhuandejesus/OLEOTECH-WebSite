<?php
include('config.php');

// VERIFICA SE O E-MAIL JÁ ESTÁ CADASTRADO
$sql = "SELECT * FROM tb_clientes WHERE email = '{$_GET['email']}';";
echo $sql;

$res = $conexao->query($sql);

if ($res->num_rows > 0) {
    header('location: cadastro.php?email=erro[userexiste]');
    exit(); //ADIONADO PARA GARANTIR QUE O SCRIPT PARA AQUI
}

//VALIDA SE FOI SELECIONADO ALGUMA OPÇÃO

$nome = $_GET['nome'];
$email = $_GET['email'];
$senha = md5($_GET['senha']);
$cep = $_GET['cep'];
$cpf = $_GET['cpf'];
$telefone = $_GET['telefone'];


//INSERÇÃO DOS DADOS NO BANCO
$sql = "INSERT INTO tb_clientes (nome, email, senha, cep, cpf, telefone) VALUES('{$nome}', '{$email}', '{$senha}', '{$cep}', '{$cpf}', '{$telefone}')";
$res = $conexao->query($sql);

//REDIRECIONA E INFORMA SE FOI CONCLUIDA A INCLUSÃO COM SUCESSO OU NÃO
if ($res == true) {
    header('location:login.php?usuario=sucesso');
} else {
    header('location:cadastro.php?usuario=falha');
}