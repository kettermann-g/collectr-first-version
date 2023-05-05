<?php

include ("configConex.php");
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

if(isset($_POST['btnExcluir'])) {
  $nomeRot = $_POST['nomeroteirista'];
  $idRoteirista = $_POST['btnExcluir'];

  echo $nomeRot."<br>";
  echo $idRoteirista."<br>";
  $query_excluir_roteirista_audiovisual = "DELETE FROM roteiristaav WHERE idRotAv = $idRoteirista AND nomeRotAv = '$nomeRot'";
  echo $query_excluir_roteirista_audiovisual."<br>";

  if (mysqli_query($conexao, $query_excluir_roteirista_audiovisual)) { //DELETOU GRAVADORA?
    header("location: roteirista_audiovisual_cadastrar_form");
  } else { //NÃO DELETOU?
    //DETELANDO OBRA
    $query_excluir_obras_roteirista = "DELETE FROM obraav WHERE idRotAv = $idRoteirista";
    echo $query_excluir_obras_roteirista."<br>";
    if (mysqli_query($conexao, $query_excluir_obras_roteirista)) {//DELETOU OBRA?
      //DELETANDO GRAVADORA
      echo "DELETANDO GRAVADORA <br>";
      mysqli_query($conexao, $query_excluir_roteirista_audiovisual);
      header("location: roteirista_audiovisual_cadastrar_form");
      ;
    } else {//NÃO DELETOU OBRA?
      //SELECIONAR OBRAS COM ID DA GRAVADORA
      $query_descobrir_obras_roteirista = "SELECT idObAv FROM obraav WHERE idRotAv = $idRoteirista";
      $res_obras_roteirista = mysqli_query($conexao, $query_descobrir_obras_roteirista);
      
      echo "DELETANDO DAS COLEÇÕES <br>";
      while($obras_roteirista = mysqli_fetch_assoc($res_obras_roteirista)) {
        $idObra = $obras_roteirista['idObAv'];
        echo $idObra."<br>";
        $query_deletar_colecao_roteirista = "DELETE FROM colecav WHERE idObAvColec = $idObra";
        echo $query_deletar_colecao_roteirista."<br>";
        mysqli_query($conexao, $query_deletar_colecao_roteirista);
      }//FIM WHILE DELETANDO OBRAS DAS COLECOES
      //DELETANDO OBRAS
      echo "DELETANDO OBRAS <br>";
      mysqli_query($conexao, $query_excluir_obras_roteirista);   
      //DELETANDO ARTISTA
      echo "DELETANDO ARTISTAS <br>";
      mysqli_query($conexao, $query_excluir_roteirista_audiovisual);
      header("location: roteirista_audiovisual_cadastrar_form"); 
    }//FIM ELSE "NÃO DELETOU OBRA?"
  }//FIM ELSE NAO DELETOU ARTISTA DA BASE DE DADOS

}
else {
  $nomeRot = $_POST['nomeRotDigit'];
  $diaNasc = $_POST['diaNasc'];
  $mesNasc = $_POST['mesNasc'];
  $anoNasc = $_POST['anoNasc'];
  $diaFalec = $_POST['diaFalec'];
  $mesFalec = $_POST['mesFalec'];
  $anoFalec = $_POST['anoFalec'];

  $query_insert_RotAv = "INSERT INTO roteiristaav (nomeRotAv, diaNascRotAv, mesNascRotAv, anoNascRotAv, diaFalecRotAv, mesFalecRotAv, anoFalecRotAv, addUserRotAv) VALUES ('$nomeRot', NULLIF('$diaNasc', ''), NULLIF('$mesNasc', ''), NULLIF('$anoNasc', ''), NULLIF('$diaFalec', ''), NULLIF('$mesFalec', ''), NULLIF('$anoFalec', ''), '$idUser') ";
  mysqli_query($conexao, $query_insert_RotAv);

  header("location: roteirista_audiovisual_cadastrar_form.php");
}




mysqli_close($conexao);

?>