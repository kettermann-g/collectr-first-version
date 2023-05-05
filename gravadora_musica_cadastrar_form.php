<?php
include("navbar.php");
include("configConex.php");
$idUser = $_SESSION['iduser'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	


	<title>Cadastro: Gravadora</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	<link rel="stylesheet" href="estilonavbar.css">
	<link rel="stylesheet" href="estiloHome.css">

  <script src="filtrar.js"></script>

	<style>
		.form-control {
      margin-bottom: 1rem;
    }
    .divform {
      width: 70%;
    }
	</style>

</head>
<body>
<?php echo $nav; ?>
	
	

	<div class="container mt-4 divform">
		<h1 class="display-6">Cadastro de gravadora na base de dados</h1>
    <p>Veja <b><a class="text-primary" data-bs-toggle="modal" data-bs-target="#modalGravMu">aqui</a></b> se o gravadora já não foi cadastrado.</p>
		<form action="gravadora_musica_cadastrar.php" id="formLabelMu" method="post">
			<label for="nomeLabel" class="form-label">Nome da Gravadora:</label><br>
			<input type="text" class="form-control" id="nomelabel" name="nomelabel">

			<input class="btn btn-dark" type="submit" value="Cadastrar">
		</form>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


  <div class="modal fade" id="modalGravMu" tabindex="-1" aria-labelledby="GravMuModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:fit-content;">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="GravMuModalLabel">Gravadoras</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input onkeyup="filtrar('pesqFiltrar', 'tabelaFiltrar')" type="text" name="pesqFiltrar" id="pesqFiltrar" class="form-control" placeholder="Filtrar">
          <p> Você também pode excluir da base de dados as gravadoras que você cadastrou.</p>
          <p class="text-danger">Todas as obras relacionadas a essa gravadora também serão excluídas.</p>
          <table class="table table-striped" id="tabelaFiltrar">
            <thead>
              <tr>
                <th>Nome</th>
                <th></th>
              </tr>
            </thead>
              <tbody>
                <?php
                  $query_select_gravadora = "SELECT idGravMu, nomeGravMu, addUserGravMu FROM gravadoramu";
                  $res_lista_gravadora = mysqli_query($conexao, $query_select_gravadora);
                  mysqli_close($conexao); 
                  if (mysqli_num_rows($res_lista_gravadora)) {
                    while($dados_lista_gravadora = mysqli_fetch_assoc($res_lista_gravadora)) {
                      $idgrav = $dados_lista_gravadora['idGravMu'];
                      $nomeGravMu = $dados_lista_gravadora['nomeGravMu'];
                      $id_user_add =  $dados_lista_gravadora['addUserGravMu'];
                      echo "<tr>";
                      echo "<td>$nomeGravMu</td>";
                      if ($id_user_add == $idUser) {
                        echo "<td><form id='form_excluir' name='form_excluir' method='post' action='gravadora_musica_cadastrar.php'><input type='hidden' name='nomeGravMu' id='nomeGravMu' value='$nomeGravMu'><button id='btnExcluir' name='btnExcluir' class='btn btn-danger btn-sm' type='submit' value='$idgrav'>Excluir</button></form></td>";
                      }
                      else {
                        echo "<td></td>";
                      }
                    }
                  }
                ?>
              </tbody>
          </table>

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</body>

</body>
</html>
