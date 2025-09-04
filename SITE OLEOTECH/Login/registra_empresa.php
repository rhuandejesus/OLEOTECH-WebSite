<?php
include('../../../Login/config.php'); // aqui o $conn já existe

$data = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;

$nome      = $conn->real_escape_string(trim($data['nome'] ?? ''));
$email     = $conn->real_escape_string(trim($data['email'] ?? ''));
$senha_raw = $data['senha'] ?? '';
$idEmpresa = (int)($data['empresa_id'] ?? 0);

// valida campos obrigatórios
if ($nome === '' || $email === '' || $senha_raw === '' || $idEmpresa === 0) {
    header('location: cadastro_coletor.php?coletor=camposfaltando');
    exit();
}

// verifica se o e-mail já existe
$sql_check = "SELECT id_coletor FROM tb_coletores WHERE email = '{$email}';";
$res_check = $conn->query($sql_check);
if ($res_check && $res_check->num_rows > 0) {
    header('location: cadastro_coletor.php?email=erro[coletorexiste]');
    exit();
}

$senha = md5($senha_raw);

// inserindo coletor
$sql = "INSERT INTO tb_coletores (nome, email, senha, idEmpresa)
        VALUES ('{$nome}', '{$email}', '{$senha}', '{$idEmpresa}')";

$res = $conn->query($sql);

if ($res) {
    header('location: historico_empresa.php?coletor=sucesso');
    exit();
} else {
    header('location: cadastro_coletor.php?coletor=falha');
    exit();
}
?>