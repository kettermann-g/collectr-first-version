<?php
include("configConex.php");
include("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cadastrar: Obra Audiovisual</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	
	<link rel="stylesheet" href="estilonavbar.css">
	<link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
	

  <style>
    .inputdata {
				position: relative;
				width: calc(100% / 3);
		}
		#dataLanc {
				display: flex;
		}
		.form-control, .form-select {
			margin-bottom: 1.5rem;
		}

		.divform {
			width: 70%
		}

		#diaLancAv {
			border-top-right-radius: 0px;
			border-bottom-right-radius: 0px;
		}
		#anoLancAv {
			border-top-left-radius: 0px;
			border-bottom-left-radius: 0px;

		}
		#mesLancAv {
			border-radius: 0px;
		}
  </style>

</head>
<body>
<?php echo $nav; ?>
	<div class="container mt-r divform">
		<h1 class="display-6">Cadastro de obra audiovisual na base de dados</h1>
		<form enctype="multipart/form-data" action="obra_audiovisual_cadastrar.php" method="post" id="formObAv">

			<!--TÍTULO AUDIOVISULAL -->
			<label for="tituloObAvDigit" class="form-label">Título:</label>
			<input type="text" class="form-control" id="tituloObAvDigit" name="tituloObAvDigit" required>

			<!--CÓDIGO DE BARRAS -->
			<label for="codBarAvDigit" class="form-label">Código de barras:</label>
			<input type="text" class="form-control" id="codBarAvDigit" name="codBarAvDigit" required>

			<!--SELECIONAR DIRETOR DA DATABASE -->
			<label for="selecDirAv" class="form-label">Diretor:</label>
			<select name="selecDirAv" id="selecDirAv" class="form-select" form="formObAv" >
				<option value="" disabled selected>Pesquisar...</option>
				<?php 

				$sql_diretores = "SELECT idDirAv, nomeDirAv FROM diretorav ORDER BY nomeDirAv";

				$result_diretores = mysqli_query($conexao, $sql_diretores);
				if (mysqli_num_rows($result_diretores)){
					while($diret_data = mysqli_fetch_assoc($result_diretores)) {
						$idDirAvDb = $diret_data['idDirAv'];
						$nomeDirAvDb = $diret_data['nomeDirAv'];

						echo "<option data-tokens='$nomeDirAvDb' value='$idDirAvDb'>$nomeDirAvDb</option>";
					} 
				}else echo "Nenhum registro";

				?>
			</select>
      <p>Não encontrou o diretor desejado?&nbsp<a href="diretor_audiovisual_cadastrar_form.php">Cadastre-o na nossa base de dados</a></p>
			
			<!--SELECIONAR ROTEIRISTA DA DATABASE -->
			<label for="selecRotAv" class="form-label">Roteirista:</label>
			<select name="selecRotAv" id="selecRotAv" class="form-select" form="formObAv">
				<option value="" disabled selected>Pesquisar...</option>
				<?php 

				$sql_roteiristas = "SELECT idRotAv, nomeRotAv FROM roteiristaav ORDER BY nomeRotAv";

				$result_roteiristas = mysqli_query($conexao, $sql_roteiristas);
				if (mysqli_num_rows($result_roteiristas)){
					while($rot_data = mysqli_fetch_assoc($result_roteiristas)) {
						$idRotAvDb = $rot_data['idRotAv'];
						$nomeRotAvDb = $rot_data['nomeRotAv'];

						echo "<option data-tokens='$nomeRotAvDb' value='$idRotAvDb'>$nomeRotAvDb</option>";
					} 
				}else echo "Nenhum registro";

				?>
			</select>
      <p>Não encontrou o roteirista desejado?&nbsp<a href="roteirista_audiovisual_cadastrar_form.php">Cadastre-o na nossa base de dados</a></p>

			<!-- SELECIONAR FORMATO DA DATABASE-->
			<label for="selecFormatoAv" class="form-label">Selecione o Formato da obra:</label>
			<select class="form-select" name="selecFormatoAv" id="selecFormatoAv" form="formObAv">
		    <?php
          $sql_formato_av = "SELECT * FROM formatoav ORDER BY idFormatoAv";

          $result_formatoAv = mysqli_query($conexao, $sql_formato_av);
          if (mysqli_num_rows($result_formatoAv) > 0){while($formatoav_data = mysqli_fetch_assoc($result_formatoAv)) {
            $nomeformatoav = $formatoav_data['nomeFormatoAv'];
            $idformatoav = $formatoav_data['idFormatoAv'];

            echo "<option value='$idformatoav'>$nomeformatoav</option>";
          }} 

        ?>
			</select>
      
      <label for="selecDistAv" class="form-label">Selecione a distribuidora:</label>
      <select name="selecDistAv" id="selecDistAv" class="form-select" form="formObAv">
				<option value="" disabled selected>Pesquisar...</option>
				<?php 

				$sql_dist = "SELECT * FROM distribav ORDER BY nomeDistAv";

				$result_dist = mysqli_query($conexao, $sql_dist);
				if (mysqli_num_rows($result_dist)){
					while($dist_data = mysqli_fetch_assoc($result_dist)) {
						$idDistDb = $dist_data['idDistAv'];
						$nomeDistDb = $dist_data['nomeDistAv'];

						echo "<option data-tokens='$nomeDistDb' value='$idDistDb'>$nomeDistDb</option>";
					} 
				}else echo "Nenhum registro";

				?>
			</select>
      <p>Não encontrou a distribuidora desejada?&nbsp<a href="distribuidora_audiovisual_cadastrar_form.php">Cadastre-a na nossa base de dados</a></p>

      <label class="form-label">Data de lançamento:</label>
      <div id="dataLanc">
        <input type="text" class="form-control inputdata" id="diaLancAv" name="diaLancAv" placeholder="Dia">
        <input type="text" class="form-control inputdata" id="mesLancAv" name="mesLancAv" placeholder="Mês">
        <input type="text" class="form-control inputdata" id="anoLancAv" name="anoLancAv" placeholder="Ano">
      </div>

      <label for="inputImgObAv">Imagem:</label>
      <input name="inputImgObAv" type="file" class="form-control" id="inputImgObAv"  required>

      <input class="btn btn-dark" type="submit" value="Cadastrar" id="botaoSubmit">

		</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
	
	<script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
</body>
</html>

<script>

	var select_box_element = document.querySelector('#selecDirAv');

	dselect(select_box_element, {
		search: true
	});

	var select_box_element2 = document.querySelector('#selecRotAv');

	dselect(select_box_element2, {
		search: true
	});

  var select_box_element3 = document.querySelector('#selecDistAv');

	dselect(select_box_element3, {
		search: true
	});

	
</script>

<?php mysqli_close($conexao); ?>