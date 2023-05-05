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
    <title>Cadastrar: Obra Visual</title>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link rel="stylesheet" href="estilonavbar.css">
		<link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
		<style>

		
		
		.form-control, .form-select {
			margin-bottom: 1.5rem;
		}

		
		
		.divform {
			width: 70%
		}
		
		</style>
</head>
<body>
  <?php echo $nav; ?>

	<div class="container mt-4 divform">
		<h1 class="display-6">Cadastro de Arte Visual na Base de Dados</h1>
		<form enctype="multipart/form-data" action="obra_visual_cadastrar.php" method="POST" id="formObVi">

			<label for="tituloObViDigit" class="form-label">Título*:</label><br>
			<input type="text" name="tituloObViDigit" id="tituloObViDigit" class="form-control" required>

			<label for="" class="form-label">Artista*:</label>
			<select name="selectArVi" id="selectArVi" class="form-select" form="formObVi" required>
				<option value="" disabled selected>Pesquisar...</option>

				<?php

				$sql_arvi = "SELECT idArVi, nomeArVi FROM artistavi ORDER BY nomeArVi";

				$result_arvi = mysqli_query($conexao, $sql_arvi);
				if (mysqli_num_rows($result_arvi)){
					while($arvi_data = mysqli_fetch_assoc($result_arvi)) {
						$idArVi = $arvi_data['idArVi'];
						$nomeArVi = $arvi_data['nomeArVi'];

						echo "<option data-tokens='$nomeArVi' value='$idArVi'>$nomeArVi</option>";
					}
				}

				?>
			</select>

			<label for="selecTipoVi" class="form-label">Tipo de obra*:</label>
			<select name="selecTipoVi" id="selecTipoVi" class="form-select" form="formObVi" requierd>
				<?php
					$sql_tipo_vi = "SELECT * FROM tipoobravi";
					$result_tipo_vi = mysqli_query($conexao, $sql_tipo_vi);
					if (mysqli_num_rows($result_tipo_vi) > 0) {
						while($tipo_vi_data = mysqli_fetch_assoc($result_tipo_vi)) {
							$nometipo = $tipo_vi_data['nomeTipoVi'];
							$idvi = $tipo_vi_data['idTipoVi'];
							
							echo "<option value='$idvi'>$nometipo</option>";
						}
					}
				?>
			</select>

			<label class="label-form" for="anoLanc">Ano*:</label>
			<input type="text" name="anoLanc" id="anoLanc" class="form-control" placeholder="Ano: AAAA" required>

      <label for="inputImgObVi">Imagem:</label>
      <input name="inputImgObVi" type="file" class="form-control" id="inputImgObVi"  required>
      
      
			
			<input class="btn btn-dark" type="submit" value="Cadastrar" id="botaoSubmit">
		</form>
	</div>
	



	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

	<script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
</body>
</html>

<script>
	var select_box_element = document.querySelector('#selectArVi');

	dselect(select_box_element, {
		search: true
	});
</script>

<?php
// *** ALTERADO POR NAIRA em 20fev23
mysqli_close($conexao); // MYSQL encerrar conexão
?>