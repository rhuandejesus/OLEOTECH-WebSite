<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link para o css do cadastro.css -->
    <link rel="stylesheet" href="cadastro.css">

    <title>Criar - Cadastro da Empresa</title>
</head>

<body>
    <div class="login-container">
        <div class="login-illustration">
            <div class="illustration-content">
                <h2 id="tituloLogo">OLEOTECH</h2>
                <p id="subtituloLogo">Descarte consciente, impacto positivo.</p>
                <div class="abstract-art">
                    <div class="circle circle-blue-light"></div>
                    <div class="circle circle-yellow"></div>
                    <div class="rectangle rectangle-blue-dark"></div>
                </div>
            </div>
        </div>



        <div class="login-form">
            <div class="logo-area">
                <!-- <img class="login-logo" src="../img/LOGOTIPO_OLEO_-removebg-preview.png" alt="Logo OLEOTECH"> -->
                <a href="../Main Page/index.html" class="botao-voltar">
                    <div class="icon-area">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" height="25px" width="25px">
                            <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" fill="#000000"></path>
                            <path d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z" fill="#000000"></path>
                        </svg>
                    </div>
                    <p>Voltar</p>
                </a>

                <h2>Criar - Cadastro da Empresa</h2>

                <p class="sign-in-text">Você precisa fornecer seus dados de acesso abaixo para entrar no sistema.</p>
            </div>
            <form action="registra_empresa.php" method="POST">
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/wpf_name.png" alt="Ícone de Usuário">
                    <input type="text" id="nome" name="nome" placeholder="Nome da Empresa" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/ic_baseline-email.png" alt="Ícone de Usuário">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/material-symbols_lock.png" alt="Ícone de Cadeado">
                    <input type="password" id="senha" name="senha" placeholder="Senha" required>
                </div>

                <!-- campos da empresa -->
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/map_postal-code.png" alt="CEP">
                    <input type="text" id="cep" name="cep" placeholder="CEP">
                </div>

                <div class="input-group">
                    <img class="input-icon" src="" alt="">
                    <input type="text" id="local" name="local" placeholder="Localização">
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/clarity_building-solid.png" alt="CNPJ">
                    <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ">
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/line-md_phone-filled.png" alt="Telefone">
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone">
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/icone_oleo.png" alt="Telefone">
                    <input type="text" id="capacidade" name="capacidade" placeholder="Capacidade de Oleo (ml)">
                </div>


                <button type="submit" class="login-button">Cadastrar</button>
            </form>

            <?php
            if (isset($_GET['empresa']) && $_GET['empresa'] === 'sucesso') { ?>
                <script>
                    alert('Empresa cadastrada com sucesso!');
                </script>
            <?php } else if (isset($_GET['empresa']) && $_GET['empresa'] === 'erro') { ?>
                <script>
                    alert('Erro ao cadastrar empresa, contate o administrador!');
                </script>
            <?php } ?>
            </form>
            <div class="links-area">
                <a href="../Login/Login.html">Já tem uma conta?</a>
            </div>
            <p class="copyright">© OLEOTECH</p>
        </div>
    </div>

</body>

</html>