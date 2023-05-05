<?php
include('configConex.php');
include("navbar.php");
$query_obvi = "SELECT idObVi, tituloObVi, artistavi.nomeArVi as artista, tipoobravi.nomeTipoVi as tipo, ano, imagemObVi, usuarios.username as addUserNome, addUserObVi, dataObravi FROM obravi
INNER JOIN artistavi ON obravi.idArVi = artistavi.idArVi
INNER JOIN tipoobravi ON obravi.idTipoVi = tipoobravi.idTipoVi
INNER JOIN usuarios ON obravi.addUserObVi = usuarios.iduser 
ORDER BY idObVi DESC";
$idUser = $_SESSION['iduser']; 
$res_vi = mysqli_query($conexao, $query_obvi);
mysqli_close($conexao);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navegar: Obras Visuais</title>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link rel="stylesheet" href="estilonavbar.css">
		<link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">

    <script src="filtrar.js"></script>

</head>
<body>
<?php echo $nav; ?>

	<br>
	<div class="container">
		<div class="campo">
			<form action="colecao_visual_adicionar.php" id="formCadColecVi" name="formCadColecMu" method="post">
				<label for="salvar_colecVi">Salvar obras selecionadas na coleção:</label>
				<button class="btn btn-dark" type="submit" id="salvar_colecVi" name="salvar_colecVi">Salvar</button>
			</form>
      <p> Você também pode excluir da base de dados as obras que você cadastrou.</p>
      <p class="text-danger">Essa obra será removida da coleção de todos os usuários que a possuem.</p>
      <input onkeyup="filtrar('pesqFiltrar', 'tabelaFiltrar')" type="text" name="pesqFiltrar" id="pesqFiltrar" class="form-control" placeholder="Filtrar">
		</div>
		<br>
	</div>

	<table class="table table-striped" id="tabelaFiltrar">
		<thead>
			<tr>
				<th>Selecionar</th>
        <th></th>
				<th>ID</th>
				<th>Título</th>
				<th>Artista</th>
				<th>Tipo</th>
				<th>Ano</th>
				<th>Adicionado por:</th>
        <th>Adicionado em:</th>
        <th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				while($dados_tabelavi = mysqli_fetch_assoc($res_vi)) {
          $imagem = $dados_tabelavi['imagemObVi'];
					$id_obvi = $dados_tabelavi['idObVi'];
          $nome_userTabela = $dados_tabelavi['addUserNome'];
          $id_userTabela = $dados_tabelavi['addUserObVi'];
					echo "<tr>";
					echo "<td><input type='checkbox' class='form-check-input' id='ch$id_obvi' name='check[]' form='formCadColecVi' value='$id_obvi'></td>";
          switch (strlen($imagem)) {
            case 0:
              echo "<td></td>";
              break;
            case strlen($imagem)>0:
              echo "<td style='max-width: 200px; max-height: 200px;'><img style='max-height: 200px; width: auto;' src='imagens/$imagem' alt=''>";
          }
					echo "<td>".$dados_tabelavi['idObVi']."</td>";
					echo "<td>".$dados_tabelavi['tituloObVi']."</td>";
					echo "<td>".$dados_tabelavi['artista']."</td>";
					echo "<td>".$dados_tabelavi['tipo']."</td>";
					echo "<td>".$dados_tabelavi['ano']."</td>";
					echo "<td>".$nome_userTabela."</td>";
          echo "<td>".$dados_tabelavi['dataObravi']."</td>";
          if ($id_userTabela == $idUser) {
            echo "<td><form action='deletar_obra_database.php' method='post'><input type='hidden' id='tabela' name='tabela' value='0'><input type='hidden' name='idOb' value='$id_obvi'><input type='submit' id='btnsubmit' name='btnsubmit' class='btn btn-danger btn-sm' value='Excluir'></form></td>";
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