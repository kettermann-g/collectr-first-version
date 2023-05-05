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
    <title>Cadastrar: Diretor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="estilonavbar.css">
    
    <script src="filtrar.js"></script>

    <style>
    .inputdata {
			position: relative;
			width: calc(100% / 3);
		}
		#dataNasc, #dataFalec {
				display: flex;
				
		}
		.form-control {
			margin-bottom: 1.5rem;
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

        <h1 class="display-6">Cadastro de diretor na base de dados</h1>
        <p>Veja <b><a class="text-primary" data-bs-toggle="modal" data-bs-target="#modalDirAv">aqui</a></b> se o diretor já não foi cadastrado.</p>
        <form action="diretor_audiovisual_cadastrar.php" id="formDirAv" method="post">
          <div class="">
            <label for="nomeDirDigit" class="form-label">Nome:</label><br>
            <input type="text" id="nomeDirDigit" required name="nomeDirDigit" class="form-control">
          </div>

          <label class="form-label">Data de nascimento:</label>
          <div id="dataNasc" class="">
            <input type="text" class="form-control inputdata" id="diaNasc" name="diaNasc" placeholder="Dia">
            <input type="text" class="form-control inputdata" id="mesNasc" name="mesNasc" placeholder="Mês">
            <input type="text" class="form-control inputdata" id="anoNasc" name="anoNasc" placeholder="Ano">
          </div>

          <label class="form-label">Data de falecimento:</label>
          <div class="" id="dataFalec">
            <input type="text" class="form-control inputdata" id="diaFalec" name="diaFalec" placeholder="Dia">
            <input type="text" class="form-control inputdata" id="mesFalec" name="mesFalec" placeholder="Mês">
            <input type="text" class="form-control inputdata" id="anoFalec" name="anoFalec" placeholder="Ano">
          </div>

          <input class="btn btn-dark" type="submit" value="Cadastrar" id="botaoSubmit">

        </form>
				
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <!-- MODAL SELECT DIRETORES AUDIOVISUAL -->
    <div class="modal fade" id="modalDirAv" tabindex="-1" aria-labelledby="DirAvModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:fit-content;">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="DirAvModalLabel">Diretores</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input onkeyup="filtrar('pesqFiltrar', 'tabelaFiltrar')" type="text" name="pesqFiltrar" id="pesqFiltrar" class="form-control" placeholder="Filtrar">
          <p> Você também pode excluir da base de dados os diretores que você cadastrou.</p>
          <p class="text-danger">Todas as obras relacionadas a esse diretor também serão excluídas.</p>
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
                  $query_lista_diretor = "SELECT idDirAv, nomeDirAv, diaNascDirAv, mesNascDirAv, anoNascDirAv, diaFalecDirAv, mesFalecDirAv, anoFalecDirAv, addUserDirAv FROM diretorav";
                  $res_lista_diretor = mysqli_query($conexao, $query_lista_diretor);
                  mysqli_close($conexao);
                  if(mysqli_num_rows($res_lista_diretor)) {
                    while ($dados_lista_diretor = mysqli_fetch_assoc($res_lista_diretor)) {
                      $id_diretor = $dados_lista_diretor['idDirAv'];
                      $id_user_add = $dados_lista_diretor['addUserDirAv'];
                      $nomeDiretor = $dados_lista_diretor['nomeDirAv'];
                      $diaN = $dados_lista_diretor['diaNascDirAv'];
                      $mesN = $dados_lista_diretor['mesNascDirAv'];
                      $anoN = $dados_lista_diretor['anoNascDirAv'];
                      $diaF = $dados_lista_diretor['diaFalecDirAv'];
                      $mesF = $dados_lista_diretor['mesFalecDirAv'];
                      $anoF = $dados_lista_diretor['anoFalecDirAv'];
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
                      echo "<td>$nomeDiretor</td>";
                      echo "<td>$data_N </td>";
                      echo "<td>$data_F </td>";
                      if ($id_user_add == $idUser) {
                        echo "<td><form id='form_excluir' name='form_excluir' method='post' action='diretor_audiovisual_cadastrar.php'><input type='hidden' name='nomediretor' id='nomediretor' value='$nomeDiretor'><button id='btnExcluir' name='btnExcluir' class='btn btn-danger btn-sm' type='submit' value='$id_diretor'>Excluir</button></form></td>";
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