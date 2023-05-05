<?php
include('configConex.php');
include("navbar.php");
$query = "SELECT IDobm, tituloObMu, artistamu.nomeArMu AS NomeArtista, formatomu.NomeFormato AS Formato, tipoobramu.nomeTipoMu AS Tipo, codBarMu, gravadoramu.nomeGravMu AS labelMu, diaLancObMu, mesLancObMu, anoLancObMu, usuarios.username as addUserNome, addUserObMu, imagemObMu, dataObraMu
FROM obramu 
    INNER JOIN artistamu ON obramu.idArMu = artistamu.idArMu
    INNER JOIN formatomu ON obramu.IDformatoMu = formatomu.IDformatoMu
    INNER JOIN tipoobramu ON obramu.IDtipoMu = tipoobramu.IDtipoMu
    INNER JOIN gravadoramu ON obramu.labelMu = gravadoramu.idGravMu
    INNER JOIN usuarios ON obramu.addUserObMu = usuarios.iduser
    ORDER BY IDobm DESC";
    

$idUser = $_SESSION['iduser']; 
$res = mysqli_query($conexao, $query);
mysqli_close($conexao);



?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navegar: Obras Musicais</title>

    <link rel="stylesheet" href="estilogeral.css">
    
		
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    

    <link rel="stylesheet" href="estilonavbar.css">

    <script src="filtrar.js"></script>

</head>
<body> 
<?php echo $nav; ?>

    <br>
    <div class="container">
      <div class="campo">
        <form name="formCadColecMu" id="formCadColecMu" action="colecao_musica_adicionar.php" method="POST">
          <label for="salvar_colec">Salvar obras selecionadas na coleção:</label>    
          <button class="btn btn-dark" type="submit" name="salvar_colec">Salvar</button>
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
						<th>Formato</th>
						<th>Tipo</th>
						<th>Código de Barras</th>
						<th>Label</th>
						<th>Lançamento</th>
						<th>Adicionado por:</th>
            <th>Adicionado em:</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($dados_tabela = mysqli_fetch_assoc($res)) {
              $id_userTabela = $dados_tabela['addUserObMu'];
              $nome_userTabela = $dados_tabela['addUserNome'];
              $id_ob = $dados_tabela['IDobm'];
              $dia = $dados_tabela['diaLancObMu'];
              $mes = $dados_tabela['mesLancObMu'];
              $ano = $dados_tabela['anoLancObMu'];
              $imagem = $dados_tabela['imagemObMu'];
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
              echo "<td><input type='checkbox' class='form-check-input' id='ch$id_ob' name='check[]' form='formCadColecMu' value='$id_ob'></td>";
              switch (strlen($imagem)) {
                case 0:
                  echo "<td></td>";
                  break;
                case strlen($imagem)>0:
                  echo "<td style='width: 180px!important; height: 150px;'><img style='height: 150px; width: auto;' src='imagens/$imagem' alt=''>";
              }
              echo "<td>".$dados_tabela['IDobm']."</td>";
              echo "<td 'max-width:150px;'>".$dados_tabela['tituloObMu']."</td>";
              echo "<td 'max-width:150px;'>".$dados_tabela['NomeArtista']."</td>";
              echo "<td 'max-width:150px;'>".$dados_tabela['Formato']."</td>";
              echo "<td 'max-width:150px;'>".$dados_tabela['Tipo']."</td>";
              echo "<td 'max-width:150px;'>".$dados_tabela['codBarMu']."</td>";
              echo "<td 'max-width:150px;'>".$dados_tabela['labelMu']."</td>";
              echo "<td 'max-width:150px;'>".$data_lanc."</td>";
              echo "<td 'max-width:150px;'>$nome_userTabela</td>";
              echo "<td 'max-width:150px;'>".$dados_tabela['dataObraMu']."</td>";
              if ($id_userTabela == $idUser) {
                echo "<td><form action='deletar_obra_database.php' method='post'><input type='hidden' id='tabela' name='tabela' value='2'><input type='hidden' name='idOb' value='$id_ob'><input type='submit' id='btnsubmit' name='btnsubmit' class='btn btn-danger btn-sm' value='Excluir'></form></td>";
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

		<script>
			
		</script>
</body>

</html>

