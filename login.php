<?php

// Iniciando a sessão
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_cache_expire(30); // Definindo o prazo para expirar a sessão em 30 minutos
	session_start();
}

// conexao
$BDhost = "localhost";
$BDusuario = "root";
$BDsenha = "";
$BD = "collectr";
$BDtabela = "usuarios";

// Ajustar charset
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
date_default_timezone_set('America/Sao_Paulo');

// Estabelecendo a conexão com o banco de dados
$conexao = mysqli_connect($BDhost,$BDusuario,$BDsenha,$BD);
if (!$conexao) 
{
    echo "<br>ERRO: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
mysqli_set_charset($conexao,'utf8');


// Recebendo os dados do formulario (form) de login da página index.html
if(!empty($_POST['username']) && !empty($_POST['senhadigitada'])) // validar se os campos foram preenchidos
{ // INICIO verificar se dados do formulário foram enviados corretamente
	
	$usernamedigitado = $_POST['username']; // username que foi digitado no formulario de login
  $escapeUser = mysqli_real_escape_string($conexao, $usernamedigitado);
	$senhadigitada = $_POST['senhadigitada']; // senha que foi digitado no formulario de login
  $escapeSenha = mysqli_real_escape_string($conexao, $senhadigitada);
	$escapeSenha = MD5($escapeSenha); // criptografar senha com md5
	
	// verificar se o usuario e senha conferem com os dados do banco de dados
	// *** ALTERADO POR NAIRA em 20fev23
  $query = "SELECT iduser, username, displayname FROM usuarios WHERE username = '$escapeUser' AND senha = '$escapeSenha' LIMIT 1";
	$escape = mysqli_real_escape_string($conexao, $query);
  $resultado = mysqli_query($conexao, $query);

	
	// ACESSO autorizado
	if(mysqli_num_rows($resultado) == 1)
	{ // INICIO username e senha corretos
		$dados = mysqli_fetch_assoc($resultado); // trabalhar com dados consultados no banco de dados
		$_SESSION['username'] = $dados['username']; // criar a variável nomecompleto na sessão e armazenar nela os dados vindos do banco de dados
		$_SESSION['displayname'] = $dados['displayname'];
		$_SESSION['iduser'] = $dados['iduser']; // *** ALTERADO POR NAIRA em 20fev23
		header("Location: homepage.php"); // redirecionar página 
	} // FIM e-mail e senha corretos

	
	// ACESSO negado
	if(mysqli_num_rows($resultado) <= 0) 
	{ // INICIO e-mail ou senha INCORRETOS
		echo "<br> Acesso negado, username e/ou senha incorretos";
		echo"<script language='javascript' type='text/javascript'>
				alert('Username e/ou senha incorretos');
				window.location.href='index.php';
			 </script>";
		//header("Location:index.html"); // redirecionar página 
	} // FIM e-mail ou senha INCORRETOS
	
} // FIM verificar se dados do formulário foram enviados corretamente
else { 
	echo"<script language='javascript' type='text/javascript'>
			alert('E-mail e/ou senha não foram enviados');
			window.location.href='index.php';
		 </script>";
	header("Location:index.php"); // redirecionar página 
}

mysqli_close($conexao) // MYSQL encerrar conexão
?>