<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['tipo_usuario'] ?? '') !== 'empresa') {
    header('location: ../../Login/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coletor</title>
    <link rel="stylesheet" href="coletor.css">
</head>

<body>
    <div class="login-container">

        <a href="../coletas_empresa.php" class="botao-voltar">
            <div class="icon-area">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" height="25px" width="25px">
                    <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" fill="#000000"></path>
                    <path d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z" fill="#000000"></path>
                </svg>
            </div>
            <p>Voltar</p>
        </a>

        <!-- Lado do formulário -->
        <div class="tabela-input">
            <form action="registra_coletor.php" method="POST">
                <!-- Container para inputs lado a lado -->
                <div class="input-row">
                    <div class="input-group">
                        <input type="text" name="nome" placeholder="Nome completo" required maxlength="100" pattern="^[A-Za-zÀ-ú\s]+$" title="O nome deve conter apenas letras e espaços">
                    </div>

                    <div class="input-group">
                        <input type="text" name="cpf" placeholder="CPF" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF válido no formato 000.000.000-00">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="E-mail" required maxlength="100" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Digite um email válido">
                    </div>

                    <div class="input-group">
                        <input type="text" name="telefone" placeholder="Telefone" required maxlength="15" pattern="^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$" title="Digite um telefone válido">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <input type="password" name="senha" placeholder="Senha" required minlength="6" maxlength="50" pattern=".{6,}" title="A senha deve ter pelo menos 6 caracteres">
                    </div>
                </div>



                <button type="submit" class="login-button">Cadastrar</button>
            </form>
        </div>

    </div>


</body>

</html>