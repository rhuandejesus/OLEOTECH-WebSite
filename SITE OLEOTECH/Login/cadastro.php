<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <title>Criar - OLEOTECH</title>
</head>

<style>

</style>


<body>
    <div class="login-container">

        <!-- ILUSTRAÇÃO -->
        <div class="login-illustration">
            <div class="illustration-content">
                <h2 id="tituloLogo">OLEOTECH</h2>
                <p id="subtituloLogo">Descarte consciente, impacto positivo.</p>
                <div class="abstract-art">
                    <div class="circle circle-blue-light"></div>
                    <div class="circle circle-blue"></div>
                </div>
            </div>
        </div>

        <!-- FORMULÁRIO -->
        <div class="login-form">
            <div class="logo-area">
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
                <p class="sign-in-text">Você precisa fornecer seus dados de acesso abaixo para entrar no sistema.</p>
            </div>

            <form action="registra_usuario.php" method="POST">
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/wpf_name.png" alt="Ícone de Usuário">
                    <input type="text" id="nome" name="nome" placeholder="Nome de Usuário" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/ic_baseline-email.png" alt="Ícone de Email">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/material-symbols_lock.png" alt="Ícone de Cadeado">
                    <input type="password" id="senha" name="senha" placeholder="Senha" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/map_postal-code.png" alt="Ícone de Localização">
                    <input type="text" id="cep" name="cep" placeholder="Cep" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/ic_round-home.png" alt="Local">
                    <div class="local-wrapper" style="display: flex; gap: 5px; width: 100%;">
                        <input type="text" id="local" name="local" placeholder="Localização" readonly maxlength="150" style="flex: 1;">
                        <input type="text" id="complemento" name="complemento" placeholder="Nº" maxlength="5" style="width: 60px;">
                    </div>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/icon_cpf.png" alt="Ícone de Documento">
                    <input type="text" id="cpf" name="cpf" placeholder="Cpf" required>
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/line-md_phone-filled.png" alt="Ícone de Telefone">
                    <input type="tel" id="telefone" name="telefone" placeholder="Telefone" required>
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
                <a href="../Login/login.php">Já tem uma conta?</a>
            </div>
            <p class="copyright">© OLEOTECH</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cepInput = document.getElementById('cep');
            const localInput = document.getElementById('local');

            cepInput.addEventListener('blur', function() {
                const cep = this.value.replace(/\D/g, ''); // remove tudo que não é número
                if (cep.length === 8) {
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (!data.erro) {
                                localInput.value = `${data.logradouro}, ${data.bairro}, ${data.localidade}/${data.uf}`;
                            } else {
                                alert('CEP não encontrado!');
                                localInput.value = '';
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao buscar CEP:', error);
                            alert('Erro ao buscar CEP');
                        });
                } else {
                    if (cep.length > 0) {
                        alert('CEP inválido!');
                        localInput.value = '';
                    }
                }
            });
        });
    </script>

</body>

</html>