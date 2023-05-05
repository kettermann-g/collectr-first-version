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
    <title>Cadastrar Artista: Visual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link rel="stylesheet" href="estilonavbar.css">

    <script src="filtrar.js"></script>

		<style>
		.inputdata {
			position: relative;
			width: calc(100% / 3);
		}
		.dataNasc {
				display: inline-flex;
				height: 30px;
		}
		.form-control {
			margin-bottom: 1.5rem;
		}

		.datas {
			display: flex;
		}
		
		.divform {
			width: 70%
		}
		#diaNasc, #diaFalec {
			border-top-right-radius: 0px;
			border-bottom-right-radius: 0px;
		}
		#anoNasc, #anoFalec {
			border-top-left-radius: 0px;
			border-bottom-left-radius: 0px;

		}
		#mesNasc, #mesFalec {
			border-radius: 0px;
		}

		</style>
</head>
<body>
  <?php echo $nav; ?>
	<div class="container mt-4 divform">
		<h1 class="display-6">Cadastro de Artista Visual na Base de Dados</h1>
    <p>Veja <b><a class="text-primary" data-bs-toggle="modal" data-bs-target="#modalArVi">aqui</a></b> se o artista já não foi cadastrado.</p>

		<form method="post" action="artista_visual_cadastrar.php" id="formArVi">
			
				<label for="nomeArViDigit" class="form-label">Nome*:</label><br>
				<input type="text" name="nomeArViDigit" id="nomeArViDigit" class="form-control" required>
			
			<label for="" class="form-label">Data de nascimento:</label>
			<div class="datas" id="dataNasc">
				<input type="text" name="diaNasc" id="diaNasc" class="form-control inputdata" placeholder="Dia: DD">
				<input type="text" name="mesNasc" id="mesNasc" class="form-control inputdata" placeholder="Mês: MM">
				<input type="text" name="anoNasc" id="anoNasc" class="form-control inputdata" placeholder="Ano: AAAA">
			</div>
			<label for="" class="form-label">Data de falescimento:</label>
			<div class="datas" id="dataFalec">
				<input type="text" name="diaFalec" id="diaFalec" class="form-control inputdata" placeholder="Dia: DD">
				<input type="text" name="mesFalec" id="mesFalec" class="form-control inputdata" placeholder="Mês: MM">
				<input type="text" name="anoFalec" id="anoFalec" class="form-control inputdata" placeholder="Ano: AAAA">
			</div>

			<input class="btn btn-dark" type="submit" value="Cadastrar" id="botaoSubmit">
		</form>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

      <!-- MODAL SELECT ARTISTAS LISTA ARTISTAS MUSICA -->
      <div class="modal fade" id="modalArVi" tabindex="-1" aria-labelledby="ArViModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:fit-content;">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ArViModalLabel">Artistas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input onkeyup="filtrar('pesqFiltrar', 'tabelaFiltrar')" type="text" name="pesqFiltrar" id="pesqFiltrar" class="form-control" placeholder="Filtrar">
          <p> Você também pode excluir da base de dados os artistas que você cadastrou.</p>
          <p class="text-danger">Todas as obras relacionadas a esse artista também serão excluídas.</p>
          <table class="table table-striped" id="tabelaFiltrar">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Falecimento</th>
                <th></th>
              </tr>
            </thead>
              <tbody>
                <?php
                  $query_lista_artistas = "SELECT idArVi, nomeArVi, diaNascArVi, mesNascArVi, anoNascArVi, diaFalecArVi, mesFalecArVi, anoFalecArVi, addUserArVi FROM artistavi";
                  $res_lista_artistas = mysqli_query($conexao, $query_lista_artistas);
                  mysqli_close($conexao);
                  if(mysqli_num_rows($res_lista_artistas)) {
                    while ($dados_lista_artistas = mysqli_fetch_assoc($res_lista_artistas)) {
                      $id_artista = $dados_lista_artistas['idArVi'];
                      $id_user_add = $dados_lista_artistas['addUserArVi'];
                      $nomeArtista = $dados_lista_artistas['nomeArVi'];
                      $diaN = $dados_lista_artistas['diaNascArVi'];
                      $mesN = $dados_lista_artistas['mesNascArVi'];
                      $anoN = $dados_lista_artistas['anoNascArVi'];
                      $diaF = $dados_lista_artistas['diaFalecArVi'];
                      $mesF = $dados_lista_artistas['mesFalecArVi'];
                      $anoF = $dados_lista_artistas['anoFalecArVi'];
                      switch (strlen($diaN)) {
                        case 1:
                          $diaN = "0".$diaN;
                          break;
                        case 0:
                          $diaN = "??";
                          break;
                      }
                      switch (strlen($mesN)) {
                        case 1:
                          $mesN = "0".$mesN;
                          break;
                        case 0:
                          $mesN = "??";
                          break;
                      }
                      if (strlen($anoN) == 0) {
                          $anoN = "????";
                      }
                      $data_N = $diaN."/".$mesN."/".$anoN;


                      switch (strlen($diaF)) {
                        case 1:
                          $diaF = "0".$diaF;
                          break;
                        case 0:
                          $diaF = "??";
                          break;
                      }
                      switch (strlen($mesF)) {
                        case 1:
                          $mesF = "0".$mesF;
                          break;
                        case 0:
                          $mesF = "??";
                          break;
                      }
                      if (strlen($anoF) == 0) {
                          $anoF = "????";
                      }
                      $data_F = $diaF."/".$mesF."/".$anoF;
                      echo "<tr>";
                      echo "<td>$nomeArtista</td>";
                      echo "<td>$data_N </td>";
                      echo "<td>$data_F </td>";
                      if ($id_user_add == $idUser) {
                        echo "<td><form id='form_excluir' name='form_excluir' method='post' action='artista_visual_cadastrar.php'><input type='hidden' name='nomeartista' id='nomeartista' value='$nomeArtista'><button id='btnExcluir' name='btnExcluir' class='btn btn-danger btn-sm' type='submit' value='$id_artista'>Excluir</button></form></td>";
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
</html>