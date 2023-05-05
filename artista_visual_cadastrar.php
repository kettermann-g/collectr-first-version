<?php
include("configConex.php");
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

if (isset($_POST['btnExcluir'])) {
  $nomeArtista = $_POST['nomeartista'];
  $idArtista = $_POST['btnExcluir'];
  $query_excluir_artista_visual = "DELETE FROM artistavi WHERE idArVi = $idArtista AND nomeArVi = '$nomeArtista'";
  echo $query_excluir_artista_visual."<br>";

  if (mysqli_query($conexao, $query_excluir_artista_visual)) { //DELETOU ARTISTA?
    echo "DELETOU ARTISTA"."<br>";
    header("location: artista_visual_cadastrar_form.php");
  } else { //NÃO DELETOU?
    //DETELANDO OBRA
    echo "NÃO DELETOU ARTISTA <br>";
    $query_excluir_obras_artista = "DELETE FROM obravi WHERE idArVi = $idArtista";
    echo $query_excluir_obras_artista."<br>";
    if (mysqli_query($conexao, $query_excluir_obras_artista)) {//DELETOU OBRA?
      echo "excluiu <br>";
      //DELETANDO ARTISTA
      echo "DELETANDO ARTISTA <br>";
      mysqli_query($conexao, $query_excluir_artista_visual);
      header("location: artista_visual_cadastrar_form.php");
    } else {//NÃO DELETOU OBRA?
      //SELECIONAR OBRAS COM ID DO ARTISTA
      $query_descobrir_obras_artista = "SELECT idObVi FROM obravi WHERE idArVi = $idArtista";
      $res_obras_artista = mysqli_query($conexao, $query_descobrir_obras_artista);
      
      echo "DELETANDO DAS COLEÇÕES <br>";
      while($obras_artista = mysqli_fetch_assoc($res_obras_artista)) {
        $idObra = $obras_artista['idObVi'];
        echo $idObra."<br>";
        $query_deletar_colecao_artista = "DELETE FROM colecvi WHERE idObVi = $idObra";
        echo $query_deletar_colecao_artista."<br>";
        mysqli_query($conexao, $query_deletar_colecao_artista);
      }//FIM WHILE DELETANDO OBRAS DAS COLECOES
      //DELETANDO OBRAS
      echo "DELETANDO OBRAS <br>";
      mysqli_query($conexao, $query_excluir_obras_artista);   
      //DELETANDO ARTISTA
      echo "DELETANDO ARTISTAS <br>";
      mysqli_query($conexao, $query_excluir_artista_visual);
      header("location: artista_visual_cadastrar_form.php"); 
    }//FIM ELSE "NÃO DELETOU OBRA?"
  }//FIM ELSE NAO DELETOU ARTISTA DA BASE DE DADOS


}
else {
  $nomeArViDigit = $_POST['nomeArViDigit'];
  $diaNasc = $_POST['diaNasc'];
  $mesNasc = $_POST['mesNasc'];
  $anoNasc = $_POST['anoNasc'];
  $diaFalec = $_POST['diaFalec'];
  $mesFalec = $_POST['mesFalec'];
  $anoFalec = $_POST['anoFalec'];

  $query_insert_arvi = "INSERT INTO artistavi (nomeArVi, diaNascArVi, mesNascArVi, anoNascArVi, diaFalecArVi, mesFalecArVi, anoFalecArVi, addUserArVi) VALUES ('$nomeArViDigit', NULLIF('$diaNasc', ''), NULLIF('$mesNasc', ''), NULLIF('$anoNasc', ''), NULLIF('$diaFalec', ''), NULLIF('$mesFalec', ''), NULLIF('$anoFalec', ''), '$idUser') ";
  mysqli_query($conexao, $query_insert_arvi);
  header("location: artista_visual_cadastrar_form.php");

}

mysqli_close($conexao);
?>