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
            background: linear-gradient(to bottom right, #fef468, #e5e6ad);
            /* Variações do seu azul */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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
                <a href="../index.php">Home</a>
                <h2>Criar</h2>

                <p class="sign-in-text">Você precisa fornecer seus dados de acesso abaixo para entrar no sistema.</p>
            </div>
            
            <form action="registra_usuario.php" method="POST">
                <div class="input-group">
                    <img class="input-icon" src="../img_login/profile.png" alt="Ícone de Usuário">
                    <input type="text" id="nome" name="nome" placeholder="Nome de Usuário" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img_login/mail.png" alt="Ícone de Email">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/padlock.png" alt="Ícone de Cadeado">
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img_login/Telefone.png" alt="Ícone de Telefone">
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>
                </div>

                <select name="perfil" id="perfil" required>
                    <option value="0">Selecione o Tipo</option>
                    <option value="Fornecedor">Fornecedor</option>
                    <option value="Coletor">Coletor</option>
                </select>



                <select name="perfil" id="perfil" required>
                    <option value="0">Selecione o Tipo</option>
                    <option value="Fornecedor">Fornecedor</option>
                    <option value="Coletor">Coletor</option>
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
                <a href="#">Já tem uma conta?</a>
            </div>
            <p class="copyright">© OLEOTECH</p>
        </div>
    </div>

</body>

</html>