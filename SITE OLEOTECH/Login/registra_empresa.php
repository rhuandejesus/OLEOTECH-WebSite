<?php
// registra_empresa.php
include('config.php'); // assume $conexao (mysqli) aqui

// usa POST se existir, senão GET (mantive compatibilidade)
$data = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;


$nome       = $conexao->real_escape_string(trim($data['nome'] ?? ''));
$email      = $conexao->real_escape_string(trim($data['email'] ?? ''));
$senha_raw  = $data['senha'] ?? '';
$cep        = $conexao->real_escape_string(trim($data['cep'] ?? ''));
$cnpj       = $conexao->real_escape_string(trim($data['cnpj'] ?? ''));
$telefone   = $conexao->real_escape_string(trim($data['telefone'] ?? ''));
$capacidade = $conexao->real_escape_string(trim($data['capacidade'] ?? 0));

// valida campos obrigatórios
if ($nome === '' || $email === '' || $senha_raw === '') {
    header('location: cadastro.php?empresa=camposfaltando');
    exit();
}

// verifica se o e-mail já existe em tb_empresas
$sql_check = "SELECT id_empresa FROM tb_empresas WHERE email = '{$email}';";
$res_check = $conexao->query($sql_check);
if ($res_check && $res_check->num_rows > 0) {
    header('location: cadastro.php?email=erro[empresaexiste]');
    exit();
}

$senha = md5($senha_raw);


$sql = "INSERT INTO tb_empresas (nome, email, senha, cep, cnpj, telefone, capacidade)
        VALUES('{$nome}', '{$email}', '{$senha}', '{$cep}', '{$cnpj}', '{$telefone}', '{$capacidade}')";


$res = $conexao->query($sql);


if ($res == true) {
    header('location: login.php?empresa=sucesso');
    exit();
} else {
    header('location: cadastro.php?empresa=falha');
    exit();
}
?>