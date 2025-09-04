<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coletor</title>
    <link rel="stylesheet" href="coletor.css">
    <script src="coletor_config.php" defer></script>
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
            <form action="coletor_config.php" method="POST">

                <div class="input-group">
                    <input type="text" name="nome" placeholder="Nome completo" required>
                </div>

                <div class="input-group">
                    <input type="text" name="cpf" placeholder="CPF (apenas números)" maxlength="11" required>
                </div>

                <div class="input-group">
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>

                <div class="input-group">
                    <input type="text" name="telefone" placeholder="Telefone" required>
                </div>

                <div class="input-group">
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>

                <input type="hidden" name="empresa_id" value="<?php echo $_SESSION['empresa_id']; ?>">

                <button type="submit" class="login-button">Cadastrar</button>
            </form>

        </div>

    </div>


</body>

</html>