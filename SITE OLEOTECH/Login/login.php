<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Login - OLEOTECH</title>
</head>

<style>
    body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #82B3F4 0%, #FFFFFF 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Container principal */
.login-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0, 30, 87, 0.15);
    display: flex;
    width: 60%;
    overflow: hidden;
}

/* Área do formulário */
.login-form {
    flex: 1;
    padding: 40px;
}

.logo-area {
    text-align: center;
    margin-bottom: 32px;
}

.logo-area h2 {
    color: #1B63C5;
    font-size: 1.8em;
    font-weight: 600;
    margin-bottom: 8px;
}

.sign-in-text {
    text-align: center;
    margin-top: 10px;
    margin-bottom: 20px;
    color: #555;
    font-size: 1em;
}

/* Inputs */
.input-group {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 15px;
    margin: 0 auto 25px auto;
    padding: 5px 10px;
    width: 100%;
    box-sizing: border-box;
}

.input-icon {
    padding: 5px;
    height: 20px;
    width: 20px;
    opacity: 0.7;
    margin-right: 10px;
}

.input-group input {
    padding: 10px 5px;
    border: none;
    font-size: 1em;
    outline: none;
    width: 100%;
}

/* Botão de login */
.login-button {
    background: #086BEC;
    color: #fff;
    font-weight: 500;
    border: none;
    border-radius: 8px;
    padding: 12px 20px;
    font-size: 1em;
    cursor: pointer;
    width: 40%;
    display: block;
    margin: 20px auto 0 auto;
}

.login-button:hover {
    background: #0553a3;
}

/* Links extras */
.links-area {
    text-align: center;
    margin-top: 10px;
}

.links-area a {
    color: #1A62C5;
    text-decoration: none;
    font-size: 1em;
}

.links-area a:hover {
    text-decoration: underline;
}

/* Rodapé */
.copyright {
    text-align: center;
    margin-top: 20px;
    color: #888;
    font-size: 0.9em;
}

/* Área lateral (ilustração) */
.login-illustration {
    width: 36%;
    background-color: #1A62C5;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
    color: white;
    text-align: center;
}

.illustration-content {
    max-width: 80%;
}

.illustration-content h2 {
    font-size: 2.5em;
    font-weight: bold;
    margin-bottom: 10px;
    color: #fff;
}

.illustration-content p {
    font-size: 1em;
    color: #e0e7ef;
    margin-bottom: 30px;
}

.abstract-art {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
}

.circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.circle-blue-light {
    background-color: #DFEDFF;
}

.circle-blue {
    background-color: #1B63C5;
    box-shadow: 0 0px 10px rgb(255, 255, 255);
}



/* Responsividade */
@media (max-width: 1024px) {
    .login-container {
        width: 80%;
    }

    .illustration-content h2 {
        font-size: 2em;
    }
}

@media (max-width: 768px) {
    body {
        flex-direction: column;
        padding: 20px;
    }

    .login-container {
        flex-direction: column;
        width: 100%;
        box-shadow: none;
    }

    .login-illustration {
        width: 100%;
        min-height: 200px;
        padding: 20px;
    }

    .login-button {
        width: 60%;
    }
}

@media (max-width: 480px) {
    .illustration-content h2 {
        font-size: 1.5em;
    }

    .illustration-content p {
        font-size: 0.9em;
    }

    .login-button {
        width: 80%;
        font-size: 0.9em;
        padding: 10px;
    }

    .input-group input {
        font-size: 0.9em;
    }

    .copyright {
        font-size: 0.8em;
    }
}

</style>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="logo-area">
                <h2>Entrar</h2>
                <p class="sign-in-text">Você precisa fornecer seus dados de acesso abaixo para entrar no sistema.</p>
            </div>
            <form action="#" method="POST">
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/ic_baseline-email.png" alt="Ícone de Usuário">
                    <input type="text" id="username" name="username" placeholder="Email do Usuário ou Empresa" required>
                </div>
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/material-symbols_lock.png" alt="Ícone de Cadeado">
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                </div>
                <button type="submit" class="login-button">Entrar</button>
            </form>
            <div class="links-area">
                <a href="alterar_senha.php">Esqueceu sua senha?</a><br>
                <a href="../Login/cadastro.php">Criar uma conta</a>
            </div>
            <p class="copyright">© OLEOTECH</p>
        </div>

        <div class="login-illustration">
            <div class="illustration-content">
                <h2>OLEOTECH</h2>
                <p>Descarte consciente, impacto positivo.</p>
                <div class="abstract-art">
                    <div class="circle circle-blue-light"></div>
                    <div class="circle circle-blue"></div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>