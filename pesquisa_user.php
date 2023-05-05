<?php
include("configConex.php");
include("navbar.php");

$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

$userPesquisa = $_GET['pesqUser'];

$query_pesq_user = "SELECT iduser, username, displayname FROM usuarios WHERE username LIKE '%$userPesquisa%' AND iduser != $idUser";

$res_user_pesq = mysqli_query($conexao, $query_pesq_user);
mysqli_close($conexao);

//var_dump($res_user_pesq);




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" href="estilonavbar.css">
</head>
<body>
  <?php echo $nav; ?>
  <div class="container shadow">
    <?php
      if(!mysqli_num_rows($res_user_pesq)) {
        echo "Procurando por: $userPesquisa <br>";
        echo "Nenhum usuário encontrado <br>";
        echo "<a class='btn btn-primary' href='javascript:history.back()' style='margin-bottom: 1rem;'>Voltar</a>";
        echo '
        <div class="row">
          <div class="col-6" id="divProcurarUser">
            <form action="#" class="d-flex" role="search" method="get" style="margin-bottom: 1rem;">
              <input class="form-control me-2 shadow" type="text" name="pesqUser" id="pesqUser" placeholder="Procurar por usuários..." aria-label="Procurar">
              <button class="btn btn-outline-success" type="submit">Procurar</button>
            </form>
          </div>
          <div class="col-6"></div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
            </body>
            </html>';
            die();

      }
      
    ?>

    <h1 class="display-4">Usuários encontrados:</h1>
    <div class="row">
      <div class="col-6" id="divProcurarUser">
        <form action="#" class="d-flex" role="search" method="get" style="margin-bottom: 1rem;">
          <input class="form-control me-2 shadow" type="text" name="pesqUser" id="pesqUser" placeholder="Procurar por usuários..." aria-label="Procurar">
          <button class="btn btn-outline-success" type="submit">Procurar</button>
        </form>
      </div>
      <div class="col-6"></div>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Username</th>
          <th>Nome</th>
          <th>ID</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(strlen($userPesquisa) > 0){
            while($dados_user = mysqli_fetch_assoc($res_user_pesq)) {
              echo "<tr>";
              echo "<td><a href='perfil.php?username=".$dados_user['username']."&iduser=".$dados_user['iduser']."'>".$dados_user['username']."</a> </td>";
              echo "<td>".$dados_user['displayname']."</td>";
              echo "<td>".$dados_user['iduser']."</td>";
              echo "</tr>";
            }
          }
          else {
            echo "<h1 class='display-6'>Pesquisa vazia</h1>";
          }
          
        ?>
      </tbody>
    </table>
    

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>