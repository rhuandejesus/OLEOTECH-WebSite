<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - OLEOTECH</title>
</head>

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom right, #68BFFE, #ADD8E6);
        /* Variações do seu azul */
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        display: flex;
        width: 85%;
        max-width: 960px;
        overflow: hidden;
    }

    .login-form {
        width: 50%;
        padding: 40px;
        background: #fff;
        border-radius: 8px;
    }

    .login-form h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .login-form p {
        margin-bottom: 15px;
        color: #666;
    }

    /* Button styles */
    .login-button {
        width: 100%;
        padding: 12px;
        background-color: #1B63C5;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    /* Button hover effect */
    .login-button:hover {
        background-color:linear-gradient(135deg, #1B63C5, #57caff);
    }

    /* Input group styles */
    .input-group {
        position: relative;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .input-group img.lock-icon {
        left: 10px;
    }

    /* Icon styles */
    .input-icon {
        position: absolute;
        left: 10px;
        width: 24px;
        height: 24px;
        pointer-events: none;
    }

    /* Input styles */
    .input-group input {
        width: 100%;
        padding: 10px 10px 10px 40px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .input-group input:focus {
        border-color: #1B63C5;
        outline: none;
    }

    .links-area {
        margin-top: 20px;
        text-align: center;
        color: #666;
    }

    .links-area a {
        color: #1B63C5;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .login-illustration {
        width: 50%;
        background: linear-gradient(135deg, #fdf4b1, #57caff);
        /* Um fundo sutilmente degradê */
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
        color: #333;
        text-align: left;
    }

    .illustration-content {
        max-width: 80%;
    }

    .illustration-content h2 {
        font-size: 2.5em;
        font-weight: bold;
        color: #1A62C5;
        margin-bottom: 10px;
    }

    .illustration-content p {
        font-size: 1em;
        color: #555;
        margin-bottom: 30px;
    }

    .abstract-art {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .circle-blue-light {
        background-color: #68BFFE;
    }

    .circle-yellow {
        background-color: #FFD242;
    }

    .rectangle {
        width: 80px;
        height: 40px;
        background-color: #086BEC;
        border-radius: 5px;
    }

    .copyright {
        margin-top: 30px;
        font-size: 0.8em;
        color: #999;
        text-align: center;
        width: 100%;
    }

    /* Estilos para telas menores (responsividade) */
    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
            width: 95%;
        }

        .login-form,
        .login-illustration {
            width: 100%;
            padding: 30px;
            align-items: center;
            text-align: center;
            justify-content: center;
        }

        .login-form {
            align-items: center;
        }

        .login-form .logo-area {
            text-align: center;
        }

        .login-form .input-group {
            flex-direction: row;
        }

        .login-illustration {
            background: #E0F7FA;
            /* Cor sólida em telas menores */
        }

        .abstract-art {
            justify-content: center;
        }
    }
</style>

<body>
    <div class="login-container">
        <div class="login-form">
            <div class="logo-area">
                <!-- <img class="login-logo" src="../img/LOGOTIPO_OLEO_-removebg-preview.png" alt="Logo OLEOTECH"> -->
                <h2>Redefinir Senha</h2>
                <p class="sign-in-text">Digite seu e-mail e a nova senha para redefinir seu acesso ao sistema.</p>
            </div>
            <form action="#" method="POST">
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/mail.png" alt="Ícone de Email">
                    <input type="email" id="email" name="email" placeholder="Seu email" required>
                </div>
                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/padlock.png" alt="Ícone de Cadeado">
                    <input type="password" id="new-password" name="new-password" placeholder="Nova senha" required>
                </div>
                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/padlock.png" alt="Ícone de Cadeado">
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar nova senha" required>
                </div>
                <button type="submit" class="login-button">Alterar Senha</button>
            </form>
            <div class="links-area">
                <a href="login.html">Voltar ao login</a>
            </div>
            <p class="copyright">© OLEOTECH</p>
        </div>
        <div class="login-illustration">
            <div class="illustration-content">
                <h2>OLEOTECH</h2>
                <p>Segurança e confiança no seu acesso.</p>
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

</html>