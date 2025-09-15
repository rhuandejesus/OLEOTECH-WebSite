<?php
session_start();

// Ajuste do include: este arquivo está em Login/Senha, o config.php está em Login/config.php
$configPath = __DIR__ . '/../config.php';
if (!file_exists($configPath)) {
    // tenta caminho alternativo (apenas por segurança)
    $configPath = __DIR__ . '/../../../Login/config.php';
}
if (!file_exists($configPath)) {
    $_SESSION['flash'] = ['error' => 'Arquivo de configuração não encontrado.'];
    header('Location: alterar_senha.php');
    exit();
}
include($configPath);

// Recebe POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: alterar_senha.php');
    exit();
}

$email = trim($_POST['email'] ?? '');
$nova_senha = trim($_POST['nova_senha'] ?? '');
$confirmar_senha = trim($_POST['confirmar_senha'] ?? '');

if ($email === '' || $nova_senha === '' || $confirmar_senha === '') {
    $_SESSION['flash'] = ['error' => 'Todos os campos são obrigatórios.'];
    header('Location: alterar_senha.php');
    exit();
}

if ($nova_senha !== $confirmar_senha) {
    $_SESSION['flash'] = ['error' => 'As senhas não coincidem.'];
    header('Location: alterar_senha.php');
    exit();
}

// Hash da nova senha
$senha_hash = md5($nova_senha);

// Tabelas existentes no seu banco (ordem: empresas -> clientes -> coletores)
$tabelas = [
    'tb_empresas'  => 'email',
    'tb_clientes'  => 'email',
    'tb_coletores' => 'email'
];

$atualizado = false;
$erroDb = null;

foreach ($tabelas as $tabela => $campo_email) {
    // Preparar SELECT verificando existência do e-mail
    $sql_check = "SELECT 1 FROM `$tabela` WHERE `$campo_email` = ? LIMIT 1";
    $stmt = $conexao->prepare($sql_check);
    if ($stmt === false) {
        // tabela pode não existir ou erro de permissão; pular
        continue;
    }

    $stmt->bind_param('s', $email);
    if (!$stmt->execute()) {
        // problema na execução -> salvar erro e pular
        $erroDb = $conexao->error;
        $stmt->close();
        continue;
    }

    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        // achou o email nessa tabela -> atualiza a senha
        $stmt->close();

        $sql_update = "UPDATE `$tabela` SET `senha` = ? WHERE `$campo_email` = ?";
        $stmt_up = $conexao->prepare($sql_update);
        if ($stmt_up === false) {
            $erroDb = $conexao->error;
            break;
        }
        $stmt_up->bind_param('ss', $senha_hash, $email);
        if ($stmt_up->execute()) {
            // sucesso
            $atualizado = true;
            $stmt_up->close();
            break;
        } else {
            $erroDb = $stmt_up->error ?: $conexao->error;
            $stmt_up->close();
            break;
        }
    } else {
        $stmt->close();
    }
}

if ($atualizado) {
    $_SESSION['flash'] = ['success' => 'Senha alterada com sucesso!'];
} else {
    if ($erroDb) {
        $_SESSION['flash'] = ['error' => 'Erro ao atualizar a senha: ' . $erroDb];
    } else {
        $_SESSION['flash'] = ['error' => 'E-mail não encontrado em nosso sistema.'];
    }
}

header('Location: alterar_senha.php');
exit();
?>