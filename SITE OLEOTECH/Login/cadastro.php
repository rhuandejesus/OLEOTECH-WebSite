<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">

    <title>Criar - OLEOTECH</title>

    <style>
        .login-illustration {
            width: 50%;
            background: linear-gradient(135deg, #57caff, #fdf4b1);
            /* Um fundo sutilmente degradê */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #333;
            text-align: left;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #1B63C5, #e5e6ad);
            /* Variações do seu azul */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /*estilizar o botao voltar*/

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
            <div class="logo-area">
                <!-- <img class="login-logo" src="../img/LOGOTIPO_OLEO_-removebg-preview.png" alt="Logo OLEOTECH"> -->


                <!--Voltar a pagina inicial-->
                <a href="../Main Page/index.html" class="botao-voltar">
                    <div class="icon-area">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" height="25px" width="25px">
                            <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" fill="#000000"></path>
                            <path d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z" fill="#000000"></path>
                        </svg>
                    </div>
                    <p>Inicio</p>
                </a>


                <h2>Criar</h2>

                <p class="sign-in-text">Você precisa fornecer seus dados de acesso abaixo para entrar no sistema.</p>
            </div>
            <form action="registra_usuario.php" method="GET">
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/profile.png" alt="Ícone de Usuário">
                    <input type="text" id="nome" name="nome" placeholder="Nome de Usuário" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/mail.png" alt="Ícone de Usuário">
                    <input type="text" id="username" name="username" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/padlock.png" alt="Ícone de Cadeado" required>
                    <input type="password" id="password" name="password" placeholder="Senha">
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/Telefone.png" alt="Ícone de Telefone">
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>
                </div>



                <select name="perfil" id="perfil">
                    <option class="option" value="0">Selecione o Tipo</option>
                    <option class="option" value="Fornecedor">Fonercedor</option>
                    <option class="option" value="Coletor">Coletor</option>
                </select>

                <?php //VALIDA SE O USUÁRIO JÁ NÃO ESTAVA CADASTRADO
                if (isset($_GET['password']) && $_GET['username'] === 'erro') { ?>
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