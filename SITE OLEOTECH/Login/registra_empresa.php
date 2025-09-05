<?php
include('../Login/config.php');

$data = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;

$nome        = $conexao->real_escape_string(trim($data['nome'] ?? ''));
$email       = $conexao->real_escape_string(trim($data['email'] ?? ''));
$senha_raw   = $data['senha'] ?? '';
$cep         = $conexao->real_escape_string(trim($data['cep'] ?? ''));
$cnpj        = $conexao->real_escape_string(trim($data['cnpj'] ?? ''));
$telefone    = $conexao->real_escape_string(trim($data['telefone'] ?? ''));
$capacidade  = $conexao->real_escape_string(trim($data['capacidade'] ?? ''));
$nome_local  = $conexao->real_escape_string(trim($data['nome_local'] ?? ''));

if ($nome === '' || $email === '' || $senha_raw === '' || $cep === '' || $nome_local === '') {
    header('location: cadastro_empresa.php?empresa=camposfaltando');
    exit();
}

$sql_check = "SELECT id_empresa FROM tb_empresas WHERE email = '{$email}';";
$res_check = $conexao->query($sql_check);
if ($res_check && $res_check->num_rows > 0) {
    header('location: cadastro_empresa.php?email=erro[empresaexiste]');
    exit();
}

$senha = md5($senha_raw);

$sql = "INSERT INTO tb_empresas 
        (nome, email, senha, cep, cnpj, telefone, capacidade, nome_local)
        VALUES 
        ('{$nome}', '{$email}', '{$senha}', '{$cep}', '{$cnpj}', '{$telefone}', '{$capacidade}', '{$nome_local}')";

$res = $conexao->query($sql);

if ($conexao->query($sql)) {
    header('location: ../Login/login.php?mensagem=sucesso');
    exit();
} else {
    header('location: cadastro_empresa.php?mensagem=falha');
    exit();
}
?>