<?php
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('BASE','Cadastro_Oleotech');
 
//criar a string de conexão
$conexao = new mysqli (HOST,USER,PASS,BASE);
$conexao -> set_charset("utf8mb4");

// Verifica se a conexão falhou
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>