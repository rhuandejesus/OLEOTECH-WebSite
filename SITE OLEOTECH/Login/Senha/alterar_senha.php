<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - OLEOTECH</title>
    <link class="iconSite" rel="icon" type="image/png" href="../../img/gota__1_-removebg-preview.png">
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

        .login-container {
            display: flex;
            width: 60%;
            min-width: 320px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 30, 87, 0.15);
            overflow: hidden;
        }

        .login-form {
            width: 50%;
            padding: 40px;
        }

        .login-form h2 {
            color: #1B63C5;
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-form p.sign-in-text {
            text-align: center;
            color: #555;
            margin-bottom: 25px;
        }

        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 5px 30px;
            margin-bottom: 25px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 1em;
            padding: 10px;
        }

        .input-icon {
            position: absolute;
            left: 10px;
            width: 24px;
            height: 24px;
            pointer-events: none;
            opacity: 0.7;
        }

        .login-button {
            width: 60%;
            padding: 12px;
            background-color: #086BEC;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 500;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        .login-button:hover {
            background-color: #0651a8;
        }

        .links-area {
            text-align: center;
            margin-top: 20px;
        }

        .links-area a {
            color: #1B63C5;
            text-decoration: none;
            font-size: 1em;
        }

        .copyright {
            text-align: center;
            margin-top: 15px;
            color: #888;
            font-size: 0.9em;
        }

        .login-illustration {
            width: 50%;
            background-color: #1A62C5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #fff;
            text-align: left;
        }

        .illustration-content h2 {
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .illustration-content p {
            font-size: 1em;
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
            background-color: #DFEDFF;
        }

        .circle-blue {
            background-color: #1B63C5;
            box-shadow: 0 0px 5px rgb(255, 255, 255);
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
            }

            .login-form,
            .login-illustration {
                width: 100%;
                padding: 30px;
                text-align: center;
            }

            .login-button {
                width: 80%;
                margin: 10px auto;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Formulário de Alterar Senha -->
        <div class="login-form">
            <h2>Redefinir Senha</h2>
            <p class="sign-in-text">Digite seu e-mail e a nova senha para redefinir seu acesso ao sistema.</p>
            <form action="alterar_senha_process.php" method="POST">
                <div class="input-group">
                    <img class="input-icon" src="../../img/imagens_login/ic_baseline-email.png" alt="Ícone de Email">
                    <input type="email" name="email" placeholder="Seu email" required>
                </div>
                <div class="input-group">
                    <img class="input-icon" src="../../img/imagens_login/material-symbols_lock.png" alt="Ícone de Cadeado">
                    <input type="password" name="nova_senha" placeholder="Nova senha" required>
                </div>
                <div class="input-group">
                    <img class="input-icon" src="../../img/imagens_login/material-symbols_lock.png" alt="Ícone de Cadeado">
                    <input type="password" name="confirmar_senha" placeholder="Confirmar nova senha" required>
                </div>
                <button type="submit" class="login-button">Alterar Senha</button>
            </form>
            <div class="links-area">
                <a href="../login.php">Voltar ao login</a>
            </div>
            <p class="copyright">© OLEOTECH</p>
        </div>

        <!-- Ilustração -->
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
