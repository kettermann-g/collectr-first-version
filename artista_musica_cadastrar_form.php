<?php

include("configConex.php");
include("navbar.php");
$idUser = $_SESSION['iduser'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Artista: Música</title>

    <link href="estilogeral.css" rel="stylesheet">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
    

    
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
		#diaFormacNasDigit, #diaFimMorte {
			border-top-right-radius: 0px;
			border-bottom-right-radius: 0px;
		}
		#anoFormacNasDigit, #anoFimMorte {
			border-top-left-radius: 0px;
			border-bottom-left-radius: 0px;

		}
		#mesFormacNasDigit, #mesFimMorte {
			border-radius: 0px;
		}

		</style>
</head>
<body>
  <?php echo $nav; ?>
	<div class="container mt-4 divform">
    <h1 class="display-6">Cadastro de artista musical na base de dados</h1>
    <div>
    <p>Veja <b><a class="text-primary" data-bs-toggle="modal" data-bs-target="#modalArMu">aqui</a></b> se o artista já não foi cadastrado.</p>
    </div>
    <form id="formArMu" action="artista_musica_cadastrar.php" method="post">
        
				<label class="form-label" for="nomeArMuDigit">Nome do artista:</label>
				<input id="nomeArMuDigit" name="nomeArMuDigit" class="form-control" required="required" type="text"/>
				
				<label class="form-label" for="tipoArMuSelec">Tipo de artista:</label>
				<select class="form-select" name="tipoArMuSelec" id="tipoArMuSelec" form="formArMu">
            <?php
              $sql_tipo_artista = "SELECT idTipoArtistaMu , nomeTipoArtistaMu FROM tipoartistamu";

              $result_tipo_artistas = mysqli_query($conexao, $sql_tipo_artista);
              if (mysqli_num_rows($result_tipo_artistas))
                {while($tipo_art_dados = mysqli_fetch_assoc($result_tipo_artistas)) {
                $nomeTipoArDb = $tipo_art_dados['nomeTipoArtistaMu'];
                $idTipoArDb = $tipo_art_dados['idTipoArtistaMu'];
  
                echo "<option data-tokens='$nomeTipoArDb' value='$idTipoArDb'>$nomeTipoArDb</option>";}
                
              }  else echo "Nenhum  registro";
              
            ?>
						
				</select><br>
				
				
				<label class="form-label">Formação da banda/Nascimento do Artista:</label>
				<div class="datas" id="dataNasc">
					<input class="form-control" id="diaFormacNasDigit" name="diaFormacNasDigit" type="text" placeholder="Dia" size="5"/>
					<input class="form-control" id="mesFormacNasDigit" name="mesFormacNasDigit" type="text" placeholder="Mês" size="5"/>
					<input class="form-control" id="anoFormacNasDigit" name="anoFormacNasDigit" type="text" placeholder="Ano" size="5" required="required"/>
				</div>
				
				<label class="form-label">Desmembramento da banda/Morte do Artista:</label>
				<div class="datas" id="dataFalec">
					<input class="form-control" id="diaFimMorte" name="diaFimMorte" type="text" placeholder="Dia" size="5"/>
					<input class="form-control" id="mesFimMorte" name="mesFimMorte" type="text" placeholder="Mês" size="5"/>
					<input class="form-control" id="anoFimMorte" name="anoFimMorte" type="text" placeholder="Ano" size="5"/>
				</div>
				

				<input class="btn btn-dark" id="botaoInput" type="submit" value="Cadastrar">
    
    </form>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <!-- MODAL SELECT ARTISTAS LISTA ARTISTAS MUSICA -->
    <div class="modal fade" id="modalArMu" tabindex="-1" aria-labelledby="ArMuModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:fit-content;">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ArMuModalLabel">Artistas</h1>
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
                <th>Tipo</th>
                <th>Formac./Nasc.</th>
                <th>Desm./Falec.</th>
                <th></th>
              </tr>
            </thead>
              <tbody>
                <?php
                  $query_lista_artistas = "SELECT idArMu, nomeArMu, tipoartistamu.nomeTipoArtistaMu AS tipo, diaFormacNas, mesFormacNas, anoFormacNas, diaFimMorte, mesFimMorte, anoFimMorte, addUserArMu FROM artistamu
                  INNER JOIN tipoartistamu ON tipoartistamu.idTipoArtistaMu = artistamu.tipoArMu";
                  $res_lista_artistas = mysqli_query($conexao, $query_lista_artistas);
                  mysqli_close($conexao);
                  if(mysqli_num_rows($res_lista_artistas)) {
                    while ($dados_lista_artistas = mysqli_fetch_assoc($res_lista_artistas)) {
                      $id_artista = $dados_lista_artistas['idArMu'];
                      $id_user_add = $dados_lista_artistas['addUserArMu'];
                      $nomeArtista = $dados_lista_artistas['nomeArMu'];
                      $tipo = $dados_lista_artistas['tipo'];
                      $diaFN = $dados_lista_artistas['diaFormacNas'];
                      $mesFN = $dados_lista_artistas['mesFormacNas'];
                      $anoFN = $dados_lista_artistas['anoFormacNas'];
                      $diaFM = $dados_lista_artistas['diaFimMorte'];
                      $mesFM = $dados_lista_artistas['mesFimMorte'];
                      $anoFM = $dados_lista_artistas['anoFimMorte'];
                      switch (strlen($diaFN)) {
                        case 1:
                          $diaFN = "0".$diaFN;
                          break;
                        case 0:
                          $diaFN = "??";
                          break;
                      }
                      switch (strlen($mesFN)) {
                        case 1:
                          $mesFN = "0".$mesFN;
                          break;
                        case 0:
                          $mesFN = "??";
                          break;
                      }
                      if (strlen($anoFN) == 0) {
                          $anoFN = "????";
                      }
                      $data_FN = $diaFN."/".$mesFN."/".$anoFN;


                      switch (strlen($diaFM)) {
                        case 1:
                          $diaFM = "0".$diaFM;
                          break;
                        case 0:
                          $diaFM = "??";
                          break;
                      }
                      switch (strlen($mesFM)) {
                        case 1:
                          $mesFM = "0".$mesFM;
                          break;
                        case 0:
                          $mesFM = "??";
                          break;
                      }
                      if (strlen($anoFM) == 0) {
                          $anoFM = "????";
                      }
                      $data_FM = $diaFM."/".$mesFM."/".$anoFM;
                      echo "<tr>";
                      echo "<td>$nomeArtista</td>";
                      echo "<td>$tipo </td>";
                      echo "<td>$data_FN </td>";
                      echo "<td>$data_FM </td>";
                      if ($id_user_add == $idUser) {
                        echo "<td><form id='form_excluir' name='form_excluir' method='post' action='artista_musica_cadastrar.php'><input type='hidden' name='nomeartista' id='nomeartista' value='$nomeArtista'><button id='btnExcluir' name='btnExcluir' class='btn btn-danger btn-sm' type='submit' value='$id_artista'>Excluir</button></form></td>";
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

<script>



  var select_box_element = document.querySelector('#tipoArMuSelec');

	dselect(select_box_element, {
		search: true
	});
</script>