<?php
include("navbar.php");
include('configConex.php');


$query_selec_av = "SELECT idObAv, tituloObAv, codBarAv, diretorav.nomeDirAv AS diretor, roteiristaav.nomeRotAv AS roteirista, formatoav.nomeFormatoAv AS formato, distribav.nomeDistAv AS nomeDistAv, diaLancAv, mesLancAv, anoLancAv, usuarios.username as addUserNome, addUserObAv, dataObraAv, imagemObAv FROM obraav
INNER JOIN diretorav ON obraav.idDirAv = diretorav.idDirAv
INNER JOIN roteiristaav ON obraav.idRotAv = roteiristaav.idRotAv
INNER JOIN formatoav ON obraav.idFormatoAv = formatoav.idFormatoAv
INNER JOIN distribav ON obraav.idDistAv = distribav.idDistAv
INNER JOIN usuarios ON obraav.addUserObAv = usuarios.iduser
ORDER BY idObAv DESC";
$idUser = $_SESSION['iduser']; 
$res = mysqli_query($conexao, $query_selec_av);
mysqli_close($conexao);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navegar: Obras Audiovisuais</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	<link rel="stylesheet" href="estilonavbar.css">

  <script src="filtrar.js"></script>
    

</head>
<body>
  <?php echo $nav; ?>
    <div class="container">
		<br>
      <div class="campo">
        <form action="colecao_audiovisual_adicionar.php" id="formCadColecAv" name="formCadColecAv" method="post">
          <label for="salvar_colec" class="form-label">Salvar obras selecionadas na coleção:</label>
          <button class="btn btn-dark" type="submit" name="salvar_colec">Salvar</button>
        </form>
        <p> Você também pode excluir da base de dados as obras que você cadastrou.</p>
        <p class="text-danger">Essa obra será removida da coleção de todos os usuários que a possuem.</p>
        <input onkeyup="filtrar('pesqFiltrar', 'tabelaFiltrar')" type="text" name="pesqFiltrar" id="pesqFiltrar" class="form-control" placeholder="Filtrar">
    	</div>
		</div>
        <table class="table table-striped" id="tabelaFiltrar">
          <thead>
            <tr>
              <th>Selecionar</th>
              <th></th>
              <th>ID</th>
              <th>Título</th>
              <th>Código de barras</th>
              <th>Diretor</th>
              <th>Roteirista</th>
              <th>Formato</th>
              <th>Distribuidora</th>
              <th>Lançamento</th>
              <th>Adicionado por:</th>
              <th>Adicionado em:</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($dados_tabela = mysqli_fetch_assoc($res)) {
                $imagem = $dados_tabela['imagemObAv'];
                $id_ob = $dados_tabela['idObAv'];
                $nome_userTabela = $dados_tabela['addUserNome'];
                $id_userTabela = $dados_tabela['addUserObAv'];
                $dia = $dados_tabela['diaLancAv'];
                $mes = $dados_tabela['mesLancAv'];
                $ano = $dados_tabela['anoLancAv'];
                switch (strlen($dia)) {
                  case 1:
                    $dia = "0".$dia;
                    break;
                  case 0:
                    $dia = "??";
                    break;
                }
                switch (strlen($mes)) {
                  case 1:
                    $mes = "0".$mes;
                    break;
                  case 0:
                    $mes = "??";
                    break;
                }
                if (strlen($ano) == 0) {
                  $ano = "????";
                }
                
                $data_lanc = $dia."/".$mes."/".$ano;
                echo "<tr>";
                echo "<td><input type='checkbox' class='form-check-input' id='ch$id_ob' name='check[]' form='formCadColecAv' value='$id_ob'></td>";
                switch (strlen($imagem)) {
                  case 0:
                    echo "<td></td>";
                    break;
                  case strlen($imagem)>0:
                    echo "<td style='max-width: 200px; max-height: 200px;'><img style='max-height: 200px; width: auto;' src='imagens/$imagem' alt=''>";
                }      
                echo "<td>".$dados_tabela['idObAv']."</td>";
                echo "<td>".$dados_tabela['tituloObAv']."</td>";
                echo "<td>".$dados_tabela['codBarAv']."</td>";
                echo "<td>".$dados_tabela['diretor']."</td>";
                echo "<td>".$dados_tabela['roteirista']."</td>";
                echo "<td>".$dados_tabela['formato']."</td>";
                echo "<td>".$dados_tabela['nomeDistAv']."</td>";
                echo "<td>".$data_lanc."</td>";
                echo "<td>".$dados_tabela['addUserNome']."</td>";
                echo "<td>".$dados_tabela['dataObraAv']."</td>";
                if ($id_userTabela == $idUser) {
                  echo "<td><form action='deletar_obra_database.php' method='post'><input type='hidden' id='tabela' name='tabela' value='1'><input type='hidden' name='idOb' value='$id_ob'><input type='submit' id='btnsubmit' name='btnsubmit' class='btn btn-danger btn-sm' value='Excluir'></form></td>";
                }
                else {
                  echo "<td></td>";
                }
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>