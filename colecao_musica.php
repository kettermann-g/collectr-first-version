<?php
include('configConex.php');
include("navbar.php");

$idUser = $_SESSION['iduser'];
$query_id_obras_colec = "SELECT c.idPecMu , c.idObMuColec, o.tituloObMu, a.nomeArMu, f.NomeFormato, t.nomeTipoMu, o.codBarMu, g.nomeGravMu, o.diaLancObMu, o.mesLancObMu, o.anoLancObMu, u.username, o.imagemObMu, c.dataAdqObraMu
	FROM colecmu AS c 
	INNER JOIN obramu AS o ON o.IDobm = c.idObMuColec 
	INNER JOIN artistamu AS a ON a.idArMu = o.idArMu
	INNER JOIN formatomu AS f ON f.IDformatoMu = o.IDformatoMu
  INNER JOIN usuarios AS u ON u.iduser = o.addUserObMu
    INNER JOIN tipoobramu AS t ON t.IDtipoMu = o.IDtipoMu
    INNER JOIN gravadoramu AS g ON g.idGravMu = o.labelMu
	WHERE c.idUserAdq = $idUser";
$res_q_ob = mysqli_query($conexao, $query_id_obras_colec);
mysqli_close($conexao);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="estilogeral.css" rel="stylesheet">

    <title>Coleção: Música</title>

    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link rel="stylesheet" href="estilonavbar.css">

    <style>
      
    </style>
</head>
<body>

<?php echo $nav; ?>

  <div class="container">
		<div class="campo">
			<h1 class="display-6">Coleção de Obras Musicais</h1>
			<form action="deletar_colecao.php" id="formDelColecVi" name="formDelColecMu" method="post">
        <input type="hidden" name="valorTabela" value="2"/>

				<input class="btn btn-dark shadow rounded" type="submit" name="delet_colecMu" id="delet_colecMu" value="Remover"/>
				<label for="delet_colecMu">&nbsp marcados da coleção</label>
			<!-- </form> --> <!-- *** ALTERADO POR NAIRA em 20fev23 || não pode terminar o form aqui --> 
		</div>
	</div>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
              <th>Selecionar</th>
              <th></th>
              <th>#</th>
              <th>ID da Obra</th>
              <th>ID da Peça</th>
              <th>Título</th>
              <th>Artista</th>
              <th>Formato</th>
              <th>Tipo</th>
              <th>Código de Barras</th>
              <th>Label</th>
              <th>Lançamento</th>
              <th>Adicionado por:</th>
              <th>Obtido em:</th>
						</tr>
        </thead>
        <tbody>
        <?php
        $contador = 0;
        while($dados_tabela_colec = mysqli_fetch_array($res_q_ob)) {
          $imagem = $dados_tabela_colec['imagemObMu'];
          $username_add = $dados_tabela_colec['username'];
          $contador++;
          $dia = $dados_tabela_colec['diaLancObMu'];
          $mes = $dados_tabela_colec['mesLancObMu'];
          $ano = $dados_tabela_colec['anoLancObMu'];
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
          echo "<td> <input type=\"checkbox\" name=\"ckListaObras[]\" value=".$dados_tabela_colec['idPecMu']."> </td>";
          switch (strlen($imagem)) {
            case 0:
              echo "<td></td>";
              break;
            case strlen($imagem)>0:
              echo "<td style='width: 180px!important; height: 150px;'><img style='height: 150px; width: auto;' src='imagens/$imagem' alt=''>";
          }
          echo "<td>".$contador."</td>";
          echo "<td>".$dados_tabela_colec['idObMuColec']."</td>";
          echo "<td>".$dados_tabela_colec['idPecMu']."</td>";
          echo "<td>".$dados_tabela_colec['tituloObMu']."</td>";
          echo "<td>".$dados_tabela_colec['nomeArMu']."</td>";
          echo "<td>".$dados_tabela_colec['NomeFormato']."</td>";
          echo "<td>".$dados_tabela_colec['nomeTipoMu']."</td>";
          echo "<td>".$dados_tabela_colec['codBarMu']."</td>";
          echo "<td>".$dados_tabela_colec['nomeGravMu']."</td>";
          echo "<td>".$data_lanc."</td>";
          echo "<td>".$username_add."</td>";
          echo "<td>".$dados_tabela_colec['dataAdqObraMu'];
          echo "</tr>";
          

        }
        
        ?>
        </form>
        </tbody>
    </table>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>