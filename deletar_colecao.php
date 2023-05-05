<?php 
/*
	*** ALTERADO POR NAIRA em 20fev23
	Precisa melhorar a interface visual desta página. 
	Eu apenas ajustei o backend para funcionar a exclusão.
*/

include('configConex.php');
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser']; // *** ALTERADO POR NAIRA em 20fev23

/* *** ALTERADO POR NAIRA em 20fev23
$query_user = "SELECT iduser FROM usuarios WHERE username = '$userSessao' LIMIT 1";
$resUser = $conexao->query($query_user);
$fetch_id = mysqli_fetch_assoc($resUser);
$idUser = $fetch_id['iduser'];*/

//var_dump($_GET['ckListaObras']); // apenas para testar a verificar o conteúdo da variável


$valorTabela = $_POST['valorTabela'];
if (0 <= $valorTabela && $valorTabela <= 2) {
  echo $valorTabela."<br>";
  $tabelas = ['colecvi', 'colecav', 'colecmu'];
  $campoId = ['idPecVi', 'idPecAv', 'idPecMu'];

  echo $tabelas[$valorTabela]."<br>";
  echo $campoId[$valorTabela]."<br>";

  $tabelaDelete = $tabelas[$valorTabela];
  $campoDelete = $campoId[$valorTabela];

  echo $tabelaDelete."<br>";
  echo $campoDelete."<br>";


  if(isset($_POST['ckListaObras']) && count($_POST['ckListaObras'])>0) {
    
      $obraDel = $_POST['ckListaObras'];
      foreach($obraDel as $item) { 
      $query_del_colec = "DELETE FROM $tabelaDelete WHERE $campoDelete = '$item'";
      echo "<br /> Excluindo da coleção do usuário $userSessao a obra com identificador $item na tabela $tabelaDelete";
      mysqli_query($conexao, $query_del_colec);
      if (mysqli_affected_rows($conexao)) {  // se houver linhas afetadas, o dado foi excluído
        echo " - Registro excluído com sucesso.";
      } else { echo " - Erro ao tentar excluir obra $item da coleção do usuário $userSessao"; }
      } // FIM foreach

  } else { echo "<h2>Nenhum registro foi enviado para exclusão.</h2>"; } // FIM else


  $paginasVoltar = ['colecao_visual.php', 'colecao_audiovisual.php', 'colecao_musica.php'];
  $voltar = $paginasVoltar[$valorTabela];
  echo "<br/><br/><a href='$voltar'>Voltar</a>";
  header('Location: '.$voltar);

}// FIM IF ENTRE 0 E 2
else {
  echo "VALOR INVÁLIDO!!!!!!!!<br/><br/><a href=homepage.php>HOMEPAGE</a>";
}

// *** ALTERADO POR NAIRA em 20fev23
mysqli_close($conexao); // MYSQL encerrar conexão
?>