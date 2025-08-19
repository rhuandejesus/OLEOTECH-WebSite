<?php
   include('config.php');
   
    // VERIFICA SE O E-MAIL JÁ ESTÁ CADASTRADO
    $sql = "SELECT * FROM usuarios WHERE email = '{$_GET['email']}'";
    $res = $conexao->query($sql);
 
    if ($res->num_rows > 0) {
        header('location: cadastro.php?email=erro[userexiste]');
        exit(); //ADIONADO PARA GARANTIR QUE O SCRIPT PARA AQUI
    }  
 
    //VALIDA SE FOI SELECIONADO ALGUMA OPÇÃO
    if($_POST['perfil'] === "Selecione o Tipo")
    {
        header('location: cadastro.php?validaperfil=erro');
    } else {
 
        $nome = $_GET['nome'];
        $email = $_GET['username'];
        $senha = md5($_GET['password']);
        $telefone = $_GET['telefone'];
        $perfil = $_GET['perfil'];
 
        //INSERÇÃO DOS DADOS NO BANCO
        $sql = "INSERT INTO usuarios(nome, email, senha, telefone, perfil) VALUES('{$nome}', '{$email}', '{$senha}','{$telefone}', '{$perfil}')";
        $res = $conexao->query($sql);
 
        //REDIRECIONA E INFORMA SE FOI CONCLUIDA A INCLUSÃO COM SUCESSO OU NÃO
        if($res==true){
            header('location:login.php?usuario=sucesso');
        } else { header('location:cadastro.php?usuario=falha');}
    }
?>