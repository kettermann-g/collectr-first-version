<?php



//VARIAVEIS CONEXAO
$BDhost = "localhost";
$BDusuario = "root";
$BDsenha = "";
$BD = "collectr";
$BDtabela = "usuarios";

$var = $_POST['cadastrar'];

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

$usernamedigitado = $_POST['username']; // username que foi digitado no formulario de login
$usernamedigitado = mysqli_real_escape_string($conexao, $usernamedigitado);
$senhadigitada = $_POST['senhadigitada']; // senha que foi digitada no formulario de login
$senhadigitada = mysqli_real_escape_string($conexao, $senhadigitada);
$confSenha = $_POST['confSenha']; //confirmação da senha que foi digitada no formulario de login
$confSenha = mysqli_real_escape_string($conexao, $confSenha);
$emaildigitado = $_POST['emaildigitado']; // email que foi digitado no formulario de login
$emaildigitado = mysqli_real_escape_string($conexao, $emaildigitado);
$displayname = $_POST['displayname']; // nome de display que foi digitado no formulario de login
$displayname = mysqli_real_escape_string($conexao, $displayname);



$checar_username_existe = "SELECT COUNT(username) as count FROM usuarios WHERE username = '$usernamedigitado'";
$resultado_username_existe = mysqli_query($conexao, $checar_username_existe);
$count = mysqli_fetch_assoc($resultado_username_existe);
$numUsers = $count['count'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="estiloLogin.css"/>
  <title>Cadastro</title>
  <style>
    .container {
      margin: auto;
      color: white;
      text-align: center;
    }
    h1 {
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>
  
  <?php
    if ($numUsers > 0) {
      echo "<div class='container'>";
      echo "<h1 class='display-1'>Esse nome de usuário já existe.</h1>";
      echo "<a class='btn btn-lg btn-dark' href='cadUser.php'>Voltar</a>";
      echo "</div>";
    }
    else {
      //RECEBDNO DADOS DE CADASTRO
      // Recebendo os dados do formulario (form) de CADASTRO da página cadastro.html
      if(!empty($usernamedigitado) && !empty($senhadigitada) && $senhadigitada == $confSenha) // validar se os campos foram preenchidos corretamente
      { // INICIO verificar se dados do formulário foram enviados corretamente
        $senhadigitada = MD5($senhadigitada); // criptografar senha com md5
        $query_insert = "INSERT INTO usuarios (username, email, senha, displayname) VALUES ('$usernamedigitado', '$emaildigitado', '$senhadigitada', '$displayname')";
        mysqli_query($conexao, $query_insert);
        echo "<div class='container'>";
        echo "<h1 class='display-1'>Cadastro realizado com sucesso!</h1>"; 
        echo "<a class='btn btn-lg btn-dark' href='index.php'>Login</a>";
        echo "</div>";
      } else {
        echo "<div class='container'>";
        echo "<h1 class='display-1'> Cadastro não efetuado. Certifique-se de que todos os campos estão devidamente preenchidos.</h1>";
        echo "<a class='btn btn-lg btn-dark' href='cadUser.php'>Voltar</a>";
        echo "</div>";
        }
    }
  ?>







<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
<?php


mysqli_close($conexao);
?>