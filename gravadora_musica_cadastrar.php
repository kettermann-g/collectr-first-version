<?php

include("configConex.php");
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

if(isset($_POST['btnExcluir'])) {
  $nomeGravMu = $_POST['nomeGravMu'];
  $idgrav = $_POST['btnExcluir'];
  $query_excluir_gravadora_musica = "DELETE FROM gravadoramu WHERE idGravMu = $idgrav AND nomeGravMu = '$nomeGravMu'";
  echo $query_excluir_gravadora_musica."<br>";

  if (mysqli_query($conexao, $query_excluir_gravadora_musica)) { //DELETOU GRAVADORA?
    echo "excluiu"."<br>";
    header("location: gravadora_musica_cadastrar_form.php");
  } else { //NÃO DELETOU?
    //DETELANDO OBRA
    echo "não excluiu <br>";
    $query_excluir_obras_gravadora = "DELETE FROM obramu WHERE labelMu = $idgrav";
    echo $query_excluir_obras_gravadora."<br>";
    if (mysqli_query($conexao, $query_excluir_obras_gravadora)) {//DELETOU OBRA?
      echo "excluiu <br>";
      //DELETANDO GRAVADORA
      echo "DELETANDO GRAVADORA <br>";
      mysqli_query($conexao, $query_excluir_gravadora_musica);
      header("location: gravadora_musica_cadastrar_form.php");
    } else {//NÃO DELETOU OBRA?
      //SELECIONAR OBRAS COM ID DA GRAVADORA
      $query_descobrir_obras_gravadora = "SELECT IDobm FROM obramu WHERE labelmu = $idgrav";
      $res_obras_gravadora = mysqli_query($conexao, $query_descobrir_obras_gravadora);
      
      echo "DELETANDO DAS COLEÇÕES <br>";
      while($obras_gravadora = mysqli_fetch_assoc($res_obras_gravadora)) {
        $idObra = $obras_gravadora['IDobm'];
        echo $idObra."<br>";
        $query_deletar_colecao_gravadora = "DELETE FROM colecmu WHERE idObMuColec = $idObra";
        echo $query_deletar_colecao_gravadora."<br>";
        mysqli_query($conexao, $query_deletar_colecao_gravadora);
      }//FIM WHILE DELETANDO OBRAS DAS COLECOES
      //DELETANDO OBRAS
      echo "DELETANDO OBRAS <br>";
      mysqli_query($conexao, $query_excluir_obras_gravadora);   
      //DELETANDO ARTISTA
      echo "DELETANDO ARTISTAS <br>";
      mysqli_query($conexao, $query_excluir_gravadora_musica);
      header("location: gravadora_musica_cadastrar_form.php"); 
    }//FIM ELSE "NÃO DELETOU OBRA?"
  }//FIM ELSE NAO DELETOU ARTISTA DA BASE DE DADOS
}//FIM IF ISSET 

else {


$nomeGravadora = $_POST['nomelabel'];

$query_insert_gravMu = "INSERT INTO gravadoramu (nomeGravMu, addUserGravMu) VALUES ('$nomeGravadora', '$idUser') ";
mysqli_query($conexao, $query_insert_gravMu);
echo "Log realizado com sucesso";
header("location: gravadora_musica_cadastrar_form.php");
}

mysqli_close($conexao);
?>