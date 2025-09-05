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
                    <div class="circle circle-blue"></div>
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
            <form class="tabela-input" action="registra_empresa.php" method="POST">
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/wpf_name.png" alt="Ícone de Usuário">
                    <input type="text" id="nome" name="nome" placeholder="Nome da Empresa" required maxlength="100">
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/ic_baseline-email.png" alt="Ícone de Usuário">
                    <input type="email" id="email" name="email" placeholder="Email" required maxlength="100">
                </div>

                <div class="input-group">
                    <img class="input-icon lock-icon" src="../img/imagens_login/material-symbols_lock.png" alt="Ícone de Cadeado">
                    <input type="password" id="senha" name="senha" placeholder="Senha" required maxlength="30">
                </div>

                <!-- campos da empresa -->
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/map_postal-code.png" alt="CEP">
                    <input type="text" id="cep" name="cep" placeholder="CEP" pattern="\d{5}-?\d{3}" maxlength="9" title="Digite um CEP válido">
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/ic_round-home.png" alt="Local">
                    <input type="text" id="local" name="nome_local" placeholder="Localização" readonly maxlength="150">
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/clarity_building-solid.png" alt="CNPJ">
                    <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ" maxlength="18" title="Digite um CNPJ válido">
                    <!-- pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" -->
                </div>

                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/line-md_phone-filled.png" alt="Telefone">
                    <input type="tel" id="telefone" name="telefone" placeholder="Telefone" maxlength="15" title="Digite um telefone válido">
                    <!-- pattern="\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}" -->
                </div>
 
                <div class="input-group">
                    <img class="input-icon" src="../img/imagens_login/icone_oleo.png" alt="Telefone">
                    <input type="number" id="capacidade" name="capacidade" placeholder="Capacidade de Oleo (ml)" min="1" max="1000000">
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
                <a href="../Login/login.php">Já tem uma conta?</a>
            </div>
            <p class="copyright">© OLEOTECH</p>
        </div>
    </div>


    <!-- Script para buscar CEP -->
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