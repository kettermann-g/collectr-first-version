<?php
include("configConex.php");
include("navbar.php"); 

include ("navbar.php");
include ("configConex.php");
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

$query_lista_seguindo_tl = "SELECT usuarios.username as usernameSeguindo, idUsuarioSeguido, usuarios.displayname as displaySeguindo FROM vinculo INNER JOIN usuarios ON usuarios.iduser = vinculo.idUsuarioSeguido WHERE idUsuario = $idUser";

$array_where_seguindo = [];

$res_seguindo_tl = mysqli_query($conexao, $query_lista_seguindo_tl);
while($seguindo_tl = mysqli_fetch_assoc($res_seguindo_tl)) {
    $idUserWhereSeguindo = $seguindo_tl['idUsuarioSeguido'];
    array_push($array_where_seguindo, $idUserWhereSeguindo);
}

$string_where_filtro = "(".implode(',', $array_where_seguindo).")";

$query_timeline = "SELECT * FROM ( SELECT colecvi.idObVi AS idObra, obravi.tituloObVi AS Titulo, tipoobravi.nomeTipoVi as tipo, idUserAdqVi as idUser, usuarios.username as username, colecvi.dataAdqObraVi as DATAadq, obravi.imagemObVi as imagem FROM colecvi
INNER JOIN obravi on colecvi.idObVi = obravi.idObVi
INNER JOIN tipoobravi on obravi.idTipoVi = tipoobravi.idTipoVi
INNER JOIN usuarios on colecvi.idUserAdqVi = usuarios.iduser
WHERE idUserAdqVi in $string_where_filtro) AS T2
UNION ALL
SELECT * FROM (SELECT colecav.idObAvColec AS idObra, obraav.tituloObAv AS Titulo, formatoav.nomeFormatoAv as tipo, idUserAdqAv as idUser, usuarios.username as username, colecav.dataAdqObraAv as DATAadq, obraav.imagemObAv FROM colecav
INNER JOIN obraav on colecav.idObAvColec = obraav.idObAv
INNER JOIN formatoav on obraav.idFormatoAv = formatoav.idFormatoAv
INNER JOIN usuarios on colecav.idUserAdqAv = usuarios.iduser
WHERE idUserAdqAv in $string_where_filtro) AS T1
UNION ALL
SELECT * FROM (SELECT colecmu.idObMuColec AS idObra, obramu.tituloObMu AS Titulo, formatomu.NomeFormato as tipo, colecmu.idUserAdq as idUser, usuarios.username as username, colecmu.dataAdqObraMu as DATAadq, obramu.imagemObMu FROM colecmu
INNER JOIN usuarios on colecmu.idUserAdq = usuarios.iduser
INNER JOIN obramu on colecmu.idObMuColec = obramu.IDobm
INNER JOIN formatomu on obramu.IDformatoMu = formatomu.IDformatoMu
WHERE idUserAdq in $string_where_filtro) AS T3
ORDER BY DATAadq DESC LIMIT 25";

$res_timeline = mysqli_query($conexao, $query_timeline);
mysqli_close($conexao);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Homepage</title>
	
	<!-- <link href="estiloHeader.css" rel="stylesheet"> -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	<link rel="stylesheet" href="estilonavbar.css">
	<link rel="stylesheet" href="estiloHome.css">

  
</head>
<body>
  
  <?php echo $nav; ?>
	<div id="rowCards">
    <div class="col-5" id="timeline">

      <?php
      if (mysqli_num_rows($res_seguindo_tl)) {
        echo "<h1 class='display-6'>Confira aqui algumas das últimas obras adquiridas pelos seus amigos</h1>";
        while($dados_timeline = mysqli_fetch_array($res_timeline)) {
          $imagem = $dados_timeline['imagem'];
          $nomeUser = $dados_timeline['username'];
          $tituloObra = $dados_timeline['Titulo'];
          $tipoObra = $dados_timeline['tipo'];
          $dataAdqObra = $dados_timeline['DATAadq'];
          $iduserTL = $dados_timeline['idUser'];
  
          echo "<div class='card-timeline shadow-sm'>
          <div class='shadow div-imagem'>
            <img class='class-img' src='imagens/$imagem' alt=''>
          </div>
          <div class='div-texto'>
            <a href='perfil.php?username=$nomeUser&iduser=$iduserTL'>$nomeUser</a> adicionou $tituloObra ($tipoObra) na sua coleção<br><br><br>
            $dataAdqObra
          </div>
        </div>"; 
        } 
      }
      else {
        echo "<h1 class='display-6'>Parace que você ainda não segue ninguém. Por que você não abre o <a href='perfil.php?username=$userSessao&iduser=$idUser'>seu perfil</a> e pesquisa alguns usuários para seguir?";
      }
        
      ?>
    </div>
		<div class="col card-links">
      <div class="conteudo-card-links shadow"  id="colMus">
        <h3 class="display-6 text-success">Música</h3>
        <a href="artista_musica_cadastrar_form.php" role="button" class="w-100 btn btn btn-outline-success btnMus" >Cadastrar artista</a>

        <a href="obra_musica_cadastrar_form.php" role="button" class="w-100 btn btn btn-outline-success btnMus">Cadastrar obra</a>

        <a href="gravadora_musica_cadastrar_form.php" role="button" class="w-100 btn btn btn-outline-success btnMus">Cadastrar gravadora</a>

        <a href="navegar_obra_musica.php" role="button" class="w-100 btn btn btn-outline-success btnMus">Navegar pelas obras cadastradas</a>
      </div>
		</div>
		<div class="col card-links" >
      <div class="conteudo-card-links shadow" id="colAV">
        <h3 class="display-6 text-primary">Audiovisual</h3>
        <a href="diretor_audiovisual_cadastrar_form.php" class="w-100 btn btn btn-outline-primary btnAV" role="button">Cadastrar diretor</a>

        <a href="obra_audiovisual_cadastrar_form.php" role="button" class="w-100 btn btn btn-outline-primary btnAV">Cadastrar obra</a>

        <a href="roteirista_audiovisual_cadastrar_form.php" role="button" class="w-100 btn btn btn-outline-primary btnAV">Cadastrar roteirista</a>

        <a href="distribuidora_audiovisual_cadastrar_form.php" role="button" class="w-100 btn btn btn-outline-primary btnAV">Cadastrar distribuidora</a>

        <a href="navegar_obra_audiovisual.php" role="button" class="w-100 btn btn btn-outline-primary btnAV">Navegar pelas obras cadastradas</a>
      </div>
		</div>
		<div class="col card-links ">
      <div class="conteudo-card-links shadow"  id="colVis">
        <h3 class="display-6 text-danger">Visual</h3>
        <a href="artista_visual_cadastrar_form.php" role="button" class="w-100 btn btn btn-outline-danger btnVis">Cadastrar artista</a>

        <a href="obra_visual_cadastrar_form.php" role="button" class="w-100 btn btn btn-outline-danger btnVis">Cadastrar obra</a>

        <a href="navegar_obra_visual.php" role="button" class="w-100 btn btn btn-outline-danger btnVis">Navegar pelas obras cadastradas</a>
      </div>
		</div>
	</div>
	
	
	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>