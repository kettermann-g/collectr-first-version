<?php

$BDhost = "localhost";
$BDusuario = "root";
$BDsenha = "";
$BD = "collectr";
$BDtabela = "usuarios";

setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
date_default_timezone_set('America/Sao_Paulo');

$conexao = mysqli_connect($BDhost,$BDusuario,$BDsenha,$BD);
if (!$conexao) 
{
    echo "<br>ERRO: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
mysqli_set_charset($conexao,'utf8');

?>