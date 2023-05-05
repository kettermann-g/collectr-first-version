<?php

session_start();

// Verificar se sessão está autenticada.
if((isset($_SESSION['username']) == true))
{
	
	header('location:homepage.php'); // redirecionar página
	exit(); // parar a execução do script porque a sessão não está autenticada
}
// ------------------------------ FIM verificação sessão
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" href="estiloLogin.css">

  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

  <style>
    
  </style>
</head>
<body>
  <div class="row">
    <div class="col" id="col1">
      <div id="slogan">
        <h1 class="display-6">Bem vindo ao</h1>
        <h2 class="display-1">Collectr</h2>
        <h3 class="display-6">Sua estante digital</h3>
      </div>
    </div>
    <div class="col" id="col2">
      <main class="form-signin w-100 m-auto shadow-lg">
        <form method="post" action="login.php"> 
          <h2 id="txtLogin">Login</h2> 
          <div class="form-floating"> 
            <input id="username" class="form-control" name="username" required="required" type="text" placeholder="Nome de usuário"/>
            <label for="usersame">Nome de usuário</label><br>
            
          </div>
            
          <div class="form-floating"> 
            <input id="senhadigitada" class="form-control" name="senhadigitada" required="required" type="password" placeholder="Senha"/> 
            <label for="senhadigitada">Senha</label><br>
            
          </div>

          <input class="w-100 btn btn-lg btn-dark shadow rounded" type="submit" value="Entrar" id="btnEntrar"/> 
          <hr>   
          <p class="link">Ainda não tem conta? <a class="btn btn-sm btn-dark shadow rounded" href="cadUser.php">Cadastre-se</a> </p>
        </form>
      </main>
    </div>
      <!-- FIM formulario de login -->
  </div>    
      
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  
</body>
</html>