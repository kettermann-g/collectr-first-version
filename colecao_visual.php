<?php


// ------------------------------ INICIO verificação sessão
// Iniciando a sessão
include("navbar.php");
include('configConex.php');
$userSessao = $_SESSION['username'];

/* *** ALTERADO POR NAIRA em 20fev23
$query_user = "SELECT iduser FROM usuarios WHERE username = '$userSessao' LIMIT 1";
$resUser = $conexao->query($query_user);
$fetch_id = mysqli_fetch_assoc($resUser);
$idUser = $fetch_id['iduser'];*/
$idUser = $_SESSION['iduser']; // *** ALTERADO POR NAIRA em 20fev23

// $query_id_obras_colec = "SELECT idPecVi, idObVi FROM colecvi WHERE idUserAdqVi = '$idUser'"; *** ALTERADO POR NAIRA em 20fev23
$query_id_obras_colec = "SELECT c.idPecVi, c.idObVi, o.tituloObVi, a.nomeArVi, t.nomeTipoVi, o.ano, o.imagemObVi, u.username as usuario, c.dataAdqObraVi
	FROM colecvi AS c 
	INNER JOIN obravi AS o ON o.idObVi = C.idObVi 
	INNER JOIN artistavi AS a ON a.idArVi = o.idArvi
	INNER JOIN tipoobravi AS t ON t.idTipoVi = o.idTipoVi
  INNER JOIN usuarios AS u ON o.addUserObVi = u.iduser
	WHERE c.idUserAdqVi = $idUser ORDER BY dataAdqObraVi desc";
$res_q_ob = mysqli_query($conexao, $query_id_obras_colec);
mysqli_close($conexao);

/*
$query_id_pecViColec = "SELECT idPecVi FROM colecvi WHERE idUserAdqVi = '$idUser'";
$res_id_colec_vi = $conexao->query($query_id_pecViColec);
$assoc_id = mysqli_fetch_assoc($res_id_colec_vi);
*/

/*while($row = mysqli_fetch_assoc($res_q_ob)){
  echo $row['idPecVi']."<br>";
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coleção: Visual</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

		<link rel="stylesheet" href="estilonavbar.css">

    

</head>
<body>
<?php echo $nav; ?>

	
	<div class="container">
		<div class="campo">
			<h1 class="display-6">Coleção de Obras Visuais</h1>
			<form action="deletar_colecao.php" id="formDelColecVi" name="formDelColecVi" method="post">
        <input type="hidden" name="valorTabela" value="0"/>

				<input class="btn btn-dark shadow rounded" type="submit" name="delet_colecVi" id="delet_colecVi" value="Remover"/>
				<label for="delet_colecVi">&nbsp marcados da coleção</label>
			<!-- </form> --> <!-- *** ALTERADO POR NAIRA em 20fev23 || não pode terminar o form aqui --> 
		</div>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Selecionar</th>
        <th></th>
				<th>#</th>
				<th>ID da obra</th>
        <th>ID da peça</th>
				<th>Título</th>
				<th>Artista</th>
				<th>Tipo</th>
				<th>Ano</th>
				<th>Adicionado por:</th>
        <th>Obtido em:</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// $res_q_ob
			$contador = 0;
			while($dados = mysqli_fetch_array($res_q_ob)) {
        $imagem = $dados['imagemObVi'];
				$contador++; // incrementa a variável contador em 1
				echo "<tr>"; // inicia linha html
				echo "<td> <input type=\"checkbox\" name=\"ckListaObras[]\" value=".$dados['idPecVi']."> </td>";
        switch (strlen($imagem)) {
          case 0:
            echo "<td></td>";
            break;
          case strlen($imagem)>0:
            echo "<td style='max-width: 200px; max-height: 200px;'><img style='max-height: 200px; width: auto;' src='imagens/$imagem' alt=''>";
        }
				echo "<td>".$contador."</td>";
				echo "<td>".$dados['idObVi']."</td>";
				echo "<td>".$dados['idPecVi']."</td>";
				echo "<td>".$dados['tituloObVi']."</td>";
				echo "<td>".$dados['nomeArVi']."</td>";
				echo "<td>".$dados['nomeTipoVi']."</td>";
				echo "<td>".$dados['ano']."</td>";
				echo "<td>".$dados['usuario']."</td>";
        echo "<td>".$dados['dataAdqObraVi']."</td>";
				echo "</tr>"; // termina linha html
			} // FIM while
			/*	*** ALTERADO POR NAIRA em 20fev23
				$c = 1;
				while($res = mysqli_fetch_assoc($res_q_ob)) {
					$idObVi = $res['idObVi'];
          $idPecVi = $res['idPecVi'];
					$query_info_obVi = "SELECT idObVi, tituloObVi, artistavi.nomeArVi as artista, tipoobravi.nomeTipoVi as tipo, ano, addUserObVi FROM ((obravi
					INNER JOIN artistavi ON obravi.idArVi = artistavi.idArVi)
					INNER JOIN tipoobravi ON obravi.idTipoVi = tipoobravi.idTipoVi) WHERE idObVi = '$idObVi'";
					$res_q_infovi = $conexao->query($query_info_obVi);
					while($dados_tabela_colecvi = mysqli_fetch_assoc($res_q_infovi)) {
						
						$id_obvi = $dados_tabela_colecvi['idObVi'];
						echo "<tr>";
						// *** ALTERADO POR NAIRA em 20fev23
						//echo "<td><input type='checkbox' class='form-check-input' id='chDel$idPecVi' name='checkDel[]' form='formDelColecVi' value='$idPecVi'></td>";
						echo "<td> <input type='checkbox' name='listaObras' value='$idPecVi'> </td>";
						echo "<td>".$c."</td>";
						$c = $c + 1;
						echo "<td>".$dados_tabela_colecvi['idObVi']."</td>";
            echo "<td>".$idPecVi."</td>";
						echo "<td>".$dados_tabela_colecvi['tituloObVi']."</td>";
						echo "<td>".$dados_tabela_colecvi['artista']."</td>";
						echo "<td>".$dados_tabela_colecvi['tipo']."</td>";
						echo "<td>".$dados_tabela_colecvi['ano']."</td>";
						echo "<td>".$dados_tabela_colecvi['addUserObVi']."</td>";
						echo "</tr>";
					}
				}*/
			?>
			</form> <!-- *** ALTERADO POR NAIRA em 20fev23 || só termina o form depois de ter adicionado os campos do formulário --> 
		</tbody>
	</table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

<?php // *** ALTERADO POR NAIRA em 20fev23
// mysqli_close($conexao); // MYSQL encerrar conexão
?>