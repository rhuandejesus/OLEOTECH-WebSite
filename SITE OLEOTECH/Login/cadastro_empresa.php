<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Criar - Cadastro da Empresa</title>

    <style>
        .login-illustration {
            width: 40%;
            background: #1B63C5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            color: white;
            box-shadow: #1B63C5;
            text-align: left;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #82B3F4 0%, #FFFFFF 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .logo-area {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-illustration {
            width: 48%;
            min-width: 320px;
            box-shadow: 0 4px 24px rgba(27, 99, 197, 0.08);
        }

        .logo-area h2{
            color: #1B63C5;
            font-size: 1.8em;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .botao-voltar {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 190px;
            height: 56px;
            border-radius: 16px;
            background: #fff;
            font-size: 18px;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            overflow: hidden;
            cursor: pointer;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            width: 60%;
            overflow: hidden;
        }

        .botao-voltar p {
            position: relative;
            z-index: 2;
            margin-left: 8px;
            transition: color 0.3s;
        }

        .botao-voltar .icon-area {
            position: absolute;
            left: 4px;
            top: 4px;
            width: 48px;
            height: 48px;
            background: #1B63C5;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: width 0.5s ease;
            z-index: 1;
        }

        .botao-voltar:hover .icon-area {
            width: 182px;
        }

        .botao-voltar:hover p {
            display: none;
        }

        #tituloLogo {
            color: #fff;
            font-size: 2.2em;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 8px;
            text-shadow: 0 2px 8px rgba(27, 99, 197, 0.15);
        }

        #subtituloLogo {
            color: #e0e7ef;
            font-size: 1.1em;
            font-weight: 400;
            margin-bottom: 18px;
            letter-spacing: 1px;
            text-shadow: 0 1px 4px rgba(27, 99, 197, 0.10);
        }

        .input-icon {
            height: 30px;
        }

        .login-illustration {
            width: 50%;
            background-color: #1A62C5;
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

        .input-icon {
            padding: 10px;
            height: 20px;
            width: 20px;
            opacity: 0.7;
            margin-right: 10px;
        }

        .lock-icon {
            width: 18px;
            height: 18px;
        }

        .input-group input {
            padding: 12px 15px;
            border: none;
            font-size: 1em;
            outline: none;
            width: 200px;
            max-width: 100%;
        }
        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 15px;
            margin-bottom: 30px;
            transition: border-color 0.3s ease;
        }

        .login-button {
            background:#086BEC;
            color: #fff;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 1em;
            cursor: pointer;
            width: 30%;
            display: block;
            margin: 0 auto;
        }

        .copyright {
            text-align: center;
            margin-top: 20px;
            color: #888;
            font-size: 0.9em;
        }

        .links-area{
            text-align: center;
            margin-top: 10px;
        }
        .links-area a {
            color: #1A62C5;
            text-decoration: none;
            font-size: 1em;
        }
    </style>
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
            <form action="registra_usuario.php" method="GET">
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/profile.png" alt="Ícone de Usuário">
                    <input type="text" id="nome" name="nome" placeholder="Nome de Usuário" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/mail.png" alt="Ícone de Usuário">
                    <input type="text" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/padlock.png" alt="Ícone de Cadeado" required>
                    <input type="password" id="senha" name="senha" placeholder="Senha">
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/padlock.png" alt="Ícone de Cadeado" required>
                    <input type="cep" id="cep" name="cep" placeholder="Cep">
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/padlock.png" alt="Ícone de Cadeado" required>
                    <input type="cpf" id="cpf" name="cpf" placeholder="Cpf">
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/Telefone.png" alt="Ícone de Telefone">
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>
                </div>


                <?php //VALIDA SE O USUÁRIO JÁ NÃO ESTAVA CADASTRADO
                if (isset($_GET['senha']) && $_GET['email'] === 'erro') { ?>
                    <div class="text-danger" style="text-align: center;"> E-Mail já cadastrado!</div>
                <?php } ?>

                <?php //VALIDA SE O PERFIL É VALIDO
                if (isset($_GET['validaperfil']) && $_GET['validaperfil'] === 'erro2') { ?>
                    <div class="text-danger" style="text-align: center;"> Obri gatório selecionar um perfil!</div>
                <?php } ?>

                <?php //VALIDA SE O PERFIL É VALIDO
                if (isset($_GET['usuario']) && $_GET['usuario'] === 'sucesso') { ?>
                    <script>
                        alert('Usuário cadastrado com Sucesso!');
                    </script>
                <?php } else if (isset($_GET['usuario']) && $_GET['usuario'] != 'sucesso') { ?>
                    <script>
                        alert('Erro ao inserir usuário no banco, contate o administador!');
                    </script>
                <?php } ?>


                <a href="Main Page/index.php" target="_self"><button type="submit" class="login-button">Cadastrar</button></a>
            </form>
            <div class="links-area">
                <a href="../Login/Login.html">Já tem uma conta?</a>
            </div>
            <p class="copyright">© OLEOTECH</p>
        </div>
    </div>

</body>

</html>




<!-- <!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #1B63C5, #e5e6ad);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding: 40px;
            width: 800px;
            max-width: 95%;
        }

        .login-form {
            margin-bottom: 20px;
        }

        .login-form h2 {
            margin-bottom: 10px;
            color: #1B1B1B;
        }

        .sign-in-text {
            margin-bottom: 30px;
            color: #666;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #1B63C5;
            outline: none;
        }

        .endereco-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .endereco-group input {
            flex: 1;
            min-width: 120px;
        }

        #cep {
            max-width: 150px;
        }

        #uf {
            max-width: 80px;
            text-transform: uppercase;
            text-align: center;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #1B63C5;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #155a9c;
        }

        /*botao*/

        .botao-voltar {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 190px;
            height: 56px;
            border-radius: 16px;
            background: #fff;
            font-size: 18px;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            overflow: hidden;
            cursor: pointer;
        }

        .botao-voltar p {
            position: relative;
            z-index: 2;
            margin-left: 8px;
            transition: color 0.3s;
        }

        .botao-voltar .icon-area {
            position: absolute;
            left: 4px;
            top: 4px;
            width: 48px;
            height: 48px;
            background: #1B63C5;
            /* verde estilo Tailwind */
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: width 0.5s ease;
            z-index: 1;
        }

        .botao-voltar:hover .icon-area {
            width: 182px;
        }

        .botao-voltar:hover p {
            display: none;
        }
    </style>
</head>

<body>
    <div class="login-container">


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


        <div class="login-form">
            <a href="../Main Page/index.html" class="botao-voltar">
                <div class="icon-area">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" height="25px" width="25px">
                        <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" fill="#000000"></path>
                        <path d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z" fill="#000000"></path>
                    </svg>
                </div>
                <p>Voltar</p>
            </a>

            <h2>Criar</h2>

            <p class="sign-in-text">Fornecessa os dados da empresa</p>
        </div>
        <form action="registra_usuario.php" method="GET">
            <div class="input-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Nome da Empresa" required>
            </div>

            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
            </div>

            <div class="input-group">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" placeholder="CEP" maxlength="8" required>
                <input type="text" id="cidade" name="cidade" placeholder="Cidade" required>
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" require>
                <input type="text" id="rua" name="rua" placeholder="Rua" require>
                <input type="text" id="uf" name="uf" placeholder="UF" maxlength="3" required>
            </div>

            <div class="input-group">
                <label for="cnpj">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ" required>
            </div>

            <div class="input-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>
            </div>

            <div class="input-group">
                <label for="capcidade">Capacidade:</label>
                <input type="text" id="capacidade" name="capacidade" placeholder="Capacidade" required>
            </div>

    </div>
    </div>
</body>

</html> -->