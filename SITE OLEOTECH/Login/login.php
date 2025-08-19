<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Login - OLEOTECH</title>
</head>
 
<body>
    <div class="login-container">

    
        <div class="login-form">
            <div class="logo-area">
                <!-- <img class="login-logo" src="../img/LOGOTIPO_OLEO_-removebg-preview.png" alt="Logo OLEOTECH"> -->
                <h2>Entrar</h2>
                <p class="sign-in-text">Você precisa fornecer seus dados de acesso abaixo para entrar no sistema.</p>
            </div>
            <form action="valida_login.php" method="POST">
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/profile.png" alt="Ícone de Usuário">
                    <input type="text" id="username" name="username" placeholder="Nome de Usuário">
                </div>
                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/padlock.png" alt="Ícone de Cadeado">
                    <input type="password" id="password" name="password" placeholder="Senha">
                </div>
 
                <a href="../Main Page/index.html" target="_self" class="login-button"> Entrar</a>
            </form>

            <div class="links-area">
                <a href="../Main Page/index.html">Esqueceu sua senha?</a>
                <a href="../Login/cadastro.php">Cadastrar</a>
            </div>

            <p class="copyright">© OLEOTECH</p>
        </div>


        <div class="login-illustration">
            <div class="illustration-content">
                <h2>OLEOTECH</h2>
                <p>Descarte consciente, impacto positivo.</p>
                <div class="abstract-art">
                    <div class="circle circle-blue-light"></div>
                    <div class="circle circle-yellow"></div>
                    <div class="rectangle rectangle-blue-dark"></div>
                </div>
            </div>
        </div>


    </div>
</body>
 
</html>