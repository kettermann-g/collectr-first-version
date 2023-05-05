<?php

include('configConex.php');
include("navbar.php");


/* $query_user = "SELECT iduser FROM usuarios WHERE username = '$userSessao' LIMIT 1";
$resUser = $conexao->query($query_user);
$fetch_id = mysqli_fetch_assoc($resUser);
 */
$idUser = $_SESSION['iduser'];
$query_id_obras_colec = "SELECT c.idPecAv, c.idObAvColec, o.tituloObAv, o.codBarAv, d.nomeDirAv, r.nomeRotAv, f.nomeFormatoAv, dis.nomeDistAv, o.diaLancAv, o.mesLancAv, o.anoLancAv, u.username AS nomeUser, c.dataAdqObraAv, o.imagemObAv
FROM colecav AS c 
INNER JOIN obraav AS o ON o.idObAv = c.idObAvColec 
INNER JOIN diretorav AS d ON d.idDirAv = o.idDirAv
INNER JOIN roteiristaav AS r ON r.idRotAv = o.idRotAv
INNER JOIN formatoav AS f ON f.idFormatoAv = o.idFormatoAv
INNER JOIN distribav AS dis ON dis.idDistAv = o.idDistAv
INNER JOIN usuarios AS u ON u.iduser = o.addUserObAv
WHERE c.idUserAdqAv = $idUser ORDER BY dataAdqObraAv DESC";
$res_q_ob = mysqli_query($conexao, $query_id_obras_colec);
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coleção: Audiovisual</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="estilonavbar.css">

</head>
<body>
<?php echo $nav; ?>
	<div class="container">
    <div class="campo">
      <h1 class="display-6">Coleção de Audiovisual</h1>
      <form action="deletar_colecao.php" id="formDelColecAv" name="formDelColecAv" method="post">
        <input type="hidden" name="valorTabela" value="1"/>

        <input class="btn btn-dark shadow rounded" type="submit" name="delet_colecAv" id="delet_colecAv" value="Remover"/>
        <label for="delet_colecAv">&nbsp marcados da coleção</label>
      
    </div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
        <th>Selecionar</th>
        <th></th>
        <th>#</th>
				<th>ID da Obra</th>
        <th>ID da Peça</th>
				<th>Título</th>
				<th>Código de Barras</th>
				<th>Diretor</th>
				<th>Roteirista</th>
				<th>Formato</th>
				<th>Distribuidora</th>
				<th>Lançamento</th>
				<th>Adicionado por:</th>
        <th>Obtido em:</th>
			</tr>
		</thead>
		<tbody>
			<?php
      $contador = 0;
      while($dados_tabela_colec = mysqli_fetch_array($res_q_ob)) {
        $imagem = $dados_tabela_colec['imagemObAv'];
        $contador++; // incrementa a variável contador em 1
        $dia = $dados_tabela_colec['diaLancAv'];
        $mes = $dados_tabela_colec['mesLancAv'];
        $ano = $dados_tabela_colec['anoLancAv'];

        $datas = array($dia, $mes);
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
        if(strlen($ano) == 0) {
          $ano = "????";
        }

        $data_lanc = $dia."/".$mes."/".$ano;
        echo "<tr>";
        echo "<td> <input type=\"checkbox\" name=\"ckListaObras[]\" value=".$dados_tabela_colec['idPecAv']."> </td>";
        switch (strlen($imagem)) {
          case 0:
            echo "<td></td>";
            break;
          case strlen($imagem)>0:
            echo "<td style='max-width: 200px; max-height: 200px;'><img style='max-height: 200px; width: auto;' src='imagens/$imagem' alt=''>";
        }
        echo "<td>".$contador."</td>";
        echo "<td>".$dados_tabela_colec['idObAvColec']."</td>";
        echo "<td>".$dados_tabela_colec['idPecAv']."</td>";
        echo "<td>".$dados_tabela_colec['tituloObAv']."</td>";
        echo "<td>".$dados_tabela_colec['codBarAv']."</td>";
        echo "<td>".$dados_tabela_colec['nomeDirAv']."</td>";
        echo "<td>".$dados_tabela_colec['nomeRotAv']."</td>";
        echo "<td>".$dados_tabela_colec['nomeFormatoAv']."</td>";
        echo "<td>".$dados_tabela_colec['nomeDistAv']."</td>";
        echo "<td>".$data_lanc."</td>";
        echo "<td>".$dados_tabela_colec['nomeUser']."</td>";
        echo "<td>".$dados_tabela_colec['dataAdqObraAv']."</td>";
        echo "</tr>";
      }
			?>
      </form>
		</tbody>
	</table>
</body>
</html>