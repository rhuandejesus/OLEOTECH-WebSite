<?php
include('../../../Login/config.php'); // assume $conexao já existe

$data = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;

$nome      = $conexao->real_escape_string(trim($data['nome'] ?? ''));
$cpf       = $conexao->real_escape_string(trim($data['cpf'] ?? ''));
$email     = $conexao->real_escape_string(trim($data['email'] ?? ''));
$senha_raw = $data['senha'] ?? '';
$telefone  = $conexao->real_escape_string(trim($data['telefone'] ?? ''));
$idEmpresa = (int)($data['empresa_id'] ?? 0);

// valida campos obrigatórios
if ($nome === '' || $cpf === '' || $email === '' || $senha_raw === '' || $telefone === '' || $idEmpresa === 0) {
    header('location: cadastro_coletor.php?erro=camposfaltando');
    exit();
}

// verifica se já existe pelo email ou CPF
$sql_check = "SELECT id_coletor FROM tb_coletores WHERE email='{$email}' OR cpf='{$cpf}'";
$res_check = $conexao->query($sql_check);

if ($res_check && $res_check->num_rows > 0) {
    header('location: cadastro_coletor.php?erro=coletorexiste');
    exit();
}

$senha = md5($senha_raw);

// insere coletor
$sql = "INSERT INTO tb_coletores (nome, cpf, email, senha, telefone, idEmpresa)
        VALUES ('{$nome}', '{$cpf}', '{$email}', '{$senha}', '{$telefone}', {$idEmpresa})";

if ($conexao->query($sql)) {
    header('location: historico_empresa.php?coletor=sucesso');
    exit();
} else {
    header('location: cadastro_coletor.php?erro=falha');
    exit();
}
?>
