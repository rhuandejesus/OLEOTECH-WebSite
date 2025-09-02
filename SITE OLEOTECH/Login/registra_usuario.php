<?php 
include('config.php'); // assume $conexao (mysqli) aqui

$data = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;

$nome        = $conexao->real_escape_string(trim($data['nome'] ?? ''));
$email       = $conexao->real_escape_string(trim($data['email'] ?? ''));
$senha_raw   = $data['senha'] ?? '';
$cep         = $conexao->real_escape_string(trim($data['cep'] ?? ''));
$local       = $conexao->real_escape_string(trim($data['local'] ?? ''));
$complemento = $conexao->real_escape_string(trim($data['complemento'] ?? ''));
$cpf         = $conexao->real_escape_string(trim($data['cpf'] ?? ''));
$telefone    = $conexao->real_escape_string(trim($data['telefone'] ?? ''));

// valida campos obrigatórios
if ($nome === '' || $email === '' || $senha_raw === '' || $cpf === '') {
    header('location: cadastro.php?usuario=camposfaltando');
    exit();
}

// verifica se o e-mail já existe em tb_clientes
$sql_check = "SELECT id_cliente FROM tb_clientes WHERE email = '{$email}';";
$res_check = $conexao->query($sql_check);
if ($res_check && $res_check->num_rows > 0) {
    header('location: cadastro.php?email=erro[usuarioexiste]');
    exit();
}

$senha = md5($senha_raw);

// inserindo usuário na tabela
$sql = "INSERT INTO tb_clientes (nome, email, senha, cep, nome_local, complemento, cpf, telefone)
        VALUES('{$nome}', '{$email}', '{$senha}', '{$cep}', '{$local}', '{$complemento}', '{$cpf}', '{$telefone}')";

$res = $conexao->query($sql);

if ($res) {
    header('location: login.php?usuario=sucesso');
    exit();
} else {
    header('location: cadastro.php?usuario=falha');
    exit();
}
?>
