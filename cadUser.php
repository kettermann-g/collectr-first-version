<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    

    <link rel="stylesheet" type="text/css" href="estiloLogin.css"/>
    <title>Cadastro</title>
</head>
<body id="bodyCad">
  <main class="form-signin w-100 m-auto" style="max-width: 30rem; top:0px!important;" id="mainCad">
    <form id="cadastrar" method="post" action="cadastro.php" name="cadastrar"> 
      <h2 id="txtLogin">Cadastro</h2> 
      <div class="form-floating"> 
        <input placeholder="Nome de usuário" class="form-control" id="username" name="username" required="required" type="text"/>
        <label for="usersame">Nome de usuário</label><br>
        
      </div>
      
      <div class="form-floating"> 
        <input placeholder="Email" class="form-control" id="emaildigitado" name="emaildigitado" required="required" type="text"/>
        <label for="emaildigitado">Email</label><br>
      </div>

      <div class="form-floating"> 
        <input class="form-control" id="displayname" name="displayname" type="text" placeholder="Nome de display (não obrigatório)"/>
        <label for="displayname">Nome de display (não obrigatório)</label><br>
        
      </div>

      <div class="form-floating">
        <input placeholder="Senha" class="form-control" id="senhadigitada" name="senhadigitada" required="required" type="password"/>
        <label for="senhadigitada">Senha</label><br>
      </div>

      <div class="form-floating">
        <input placeholder="Confirme a senha" class="form-control" id="confSenha" name="confSenha" required="required" type="password"/> 
        <label for="confSenha">Confirme a senha</label><br>
      </div>

      <input class="w-100 btn btn-lg btn-dark shadow rounded" type="submit" value="Cadastrar" id="cadastrar" name="cadastrar"/>  
      <hr>  
      <a class="btn btn-sm btn-dark shadow rounded" href="index.php">Voltar</a>
    </form>
  </main>

    
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  
</body>
</html>
