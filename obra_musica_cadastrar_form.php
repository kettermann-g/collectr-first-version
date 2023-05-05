<?php
include("configConex.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cadastrar: Obra Musical</title>

	<link rel="stylesheet" href="estilogeral.css">
	

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	
	
	<link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">


	<link rel="stylesheet" href="estilonavbar.css">
	<style>

		.form-select, .form-control {
			margin-bottom: 1.5rem!important;
		}
		

		#diaLanc, #mesLanc, #anoLanc { 
			width: calc(100% /3);
		}
		
		#diaLanc {
			border-top-right-radius: 0px!important;
			border-bottom-right-radius: 0px!important;
		}
		#anoLanc {
			border-top-left-radius: 0px!important;
			border-bottom-left-radius: 0px!important;

		}
		#mesLanc {
			border-radius: 0px!important;
		}
    .divform {
      width: 70%;
    }
		
	</style>
	

</head>
<body>
<?php echo $nav; ?>
	<div class="container mt-4 divform">
	<h1 class="display-6">Cadastro de obra de música na base de dados</h1>
		<form id="formObMu" action="obra_musica_cadastrar.php" enctype="multipart/form-data" method="post">
			 
				
					   
      <!-- TITULO DA OBRA -->
      <label for="nomeArMuDigit" class="form-label">Título da peça:</label><br>
      <input class="form-control" id="nomeArMuDigit" name="nomeArMuDigit" required="required" type="text"/>
      
      <!-- SELECT ARTISTA PRA LINKAR A OBRA -->
      <label for="selecArDB" class="form-label">Selecione o artista:</label><br>
      <select class="form-select" name="selecArDB" id="selecArDB" form="formObMu" required>
        <option value="" disabled selected>Pesquisar...</option>
        <?php 
        
        $sql_artistas = "SELECT idArMu, nomeArMu FROM artistamu ORDER BY nomeArMu";

        $result_artistas = mysqli_query($conexao, $sql_artistas);
        if (mysqli_num_rows($result_artistas))
          {while($art_data = mysqli_fetch_assoc($result_artistas)) {
          $nomeArDb = $art_data['nomeArMu'];
          $idArDb = $art_data['idArMu'];

          echo "<option data-tokens='$nomeArDb' value='$idArDb'>$nomeArDb</option>";}
          
        }  else echo "Nenhum  registro";
        
        ?>
      </select>
      <p>Não encontrou o artista desejado? <a href="artista_musica_cadastrar_form.php">Cadastre-o na nossa base de dados</a></p>
      
      <!-- SELECIONAR TIPO DA OBRA -->
      <label for="selecTipoDB" class="form-label">Selecione o Tipo da obra:</label><br>
      <select class="form-select" name="selecTipoDB" id="selecTipoDB" form="formObMu">
        <?php
        $sql_tipo_obra = "SELECT * FROM tipoobramu ORDER BY IDtipoMu";

        $result_tipos = mysqli_query($conexao, $sql_tipo_obra);
        if (mysqli_num_rows($result_tipos) > 0){
          while($tipo_data = mysqli_fetch_assoc($result_tipos)) {
          $nometipo = $tipo_data['nomeTipoMu'];
          $idtipo = $tipo_data['IDtipoMu'];

          echo "<option value='$idtipo'>$nometipo</option>";}

        }  else echo "Nenhum  registro";
        

        ?>
      </select>
      
      <!-- SELECIONAR FORMATO DA OBRA -->
      <label for="selecFormatoDB" class="form-label">Selecione o Formato da obra:</label><br>
      <select class="form-select" name="selecFormatoDB" id="selecFormatoDB" form="formObMu">
        <?php
        $sql_formato_obra = "SELECT * FROM formatomu ORDER BY IDformatoMu";

        $result_formato = mysqli_query($conexao, $sql_formato_obra);
        if (mysqli_num_rows($result_formato) > 0){while($formato_data = mysqli_fetch_assoc($result_formato)) {
          $nomeformato = $formato_data['NomeFormato'];
          $idformato = $formato_data['IDformatoMu'];

          echo "<option value='$idformato'>$nomeformato</option>";
        }} 
        

        ?>
      </select>
      
      <!-- INSERIR CÓDIGO DE BARRAS -->
      <label for="codBar" class="form-label">Código de Barras:</label><br>
      <input class="form-control" type="text" name="codBar" id="codBar">

      <!-- INSERIR LABEL -->
      <label for="nomeLabel" class="form-label">Selecione a Label/Gravadora:</label><br>
      <select class="form-select" name="nomeLabel" id="nomeLabel" form="formObMu">
        <option value="" disabled selected>Pesquisar...</option>
        <?php 
        
        $sql_gravs = "SELECT idGravMu, nomeGravMu FROM gravadoramu ORDER BY nomeGravMu";

        $result_gravs = mysqli_query($conexao, $sql_gravs);
        if (mysqli_num_rows($result_gravs))
          {while($grav_data = mysqli_fetch_assoc($result_gravs)) {
          $nomeGravDb = $grav_data['nomeGravMu'];
          $idGravDb = $grav_data['idGravMu'];

          echo "<option data-tokens='$nomeGravDb' value='$idGravDb'>$nomeGravDb</option>";}
          
        }  else echo "Nenhum  registro";
        
        ?>
      </select>
      <p>Não encontrou a gravadora desejada? <a href="gravadora_musica_cadastrar_form.php">Cadastre-a na nossa base de dados</a></p>

      <!-- INSERIR DATA DE LANÇAMENTO -->
      <label class="form-label">Data de Lançamento:</label><br>
      <div style="display: flex;" id="rowData">
        <input class="form-control" id="diaLanc" name="diaLanc" type="text" placeholder="Dia">
        <input class="form-control" id="mesLanc" name="mesLanc" type="text" placeholder="Mês">
        <input class="form-control" id="anoLanc" name="anoLanc" type="text" placeholder="Ano">
      </div>
      
      <label for="inputImgObMu">Imagem:</label>

      <input type="file" class="form-control" name="inputImgObMu" id="inputImgObMu">

      <input class="btn btn-dark" type="submit" value="Cadastrar">
				
		</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
	
	<script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
	
</body>
</html>

<script>

	var select_box_element = document.querySelector('#selecArDB');

	dselect(select_box_element, {
		search: true
	});

	var select_box_element2 = document.querySelector('#nomeLabel');

	dselect(select_box_element2, {
		search: true
	});

</script>

<?php mysqli_close($conexao); ?>