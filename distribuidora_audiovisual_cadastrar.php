<?php

include ("configConex.php");
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

if (isset($_POST['btnExcluir'])) {
  $nomeDist = $_POST['nomeDist'];
  $idDist = $_POST['btnExcluir'];

  echo " $nomeDist $idDist <br>";
  $query_excluir_distribuidora_audiovisual = "DELETE FROM distribav WHERE idDistAv = $idDist AND nomeDistAv = '$nomeDist'";
  echo $query_excluir_distribuidora_audiovisual."<br>";

  if (mysqli_query($conexao, $query_excluir_distribuidora_audiovisual)) { //DELETOU GRAVADORA?
    echo "excluiu firme"."<br>";
    header("location: distribuidora_audiovisual_cadastrar_form.php");
  } else { //NÃO DELETOU?
    //DETELANDO OBRA
    echo "deu ruim firme, não excluiu <br>";
    $query_excluir_obras_distribuidora = "DELETE FROM obraav WHERE idDistAv = $idDist";
    echo $query_excluir_obras_distribuidora."<br>";
    if (mysqli_query($conexao, $query_excluir_obras_distribuidora)) {//DELETOU OBRA?
      echo "excluiu <br>";
      //DELETANDO GRAVADORA
      echo "DELETANDO GRAVADORA <br>";
      mysqli_query($conexao, $query_excluir_distribuidora_audiovisual);
      header("location: distribuidora_audiovisual_cadastrar_form.php");
    } else {//NÃO DELETOU OBRA?
      //SELECIONAR OBRAS COM ID DA GRAVADORA
      $query_descobrir_obras_distribuidora = "SELECT idObAv FROM obraav WHERE idDistAv = $idDist";
      $res_obras_distribuidora = mysqli_query($conexao, $query_descobrir_obras_distribuidora);
      
      echo "DELETANDO DAS COLEÇÕES <br>";
      while($obras_distribuidora = mysqli_fetch_assoc($res_obras_distribuidora)) {
        $idObra = $obras_distribuidora['idObAv'];
        echo $idObra."<br>";
        $query_deletar_colecao_distribuidora = "DELETE FROM colecav WHERE idObAvColec = $idObra";
        echo $query_deletar_colecao_distribuidora."<br>";
        mysqli_query($conexao, $query_deletar_colecao_distribuidora);
      }//FIM WHILE DELETANDO OBRAS DAS COLECOES
      //DELETANDO OBRAS
      echo "DELETANDO OBRAS <br>";
      mysqli_query($conexao, $query_excluir_obras_distribuidora);   
      //DELETANDO ARTISTA
      echo "DELETANDO ARTISTAS <br>";
      mysqli_query($conexao, $query_excluir_distribuidora_audiovisual);
      header("location: distribuidora_audiovisual_cadastrar_form.php"); 
    }//FIM ELSE "NÃO DELETOU OBRA?"
  }//FIM ELSE NAO DELETOU ARTISTA DA BASE DE DADOS

}
else {
  $nomeDist = $_POST['nomeDistDigit'];

  $query_insert_dist = "INSERT INTO distribav (nomeDistAv, addUserDistAv) VALUES ('$nomeDist', '$idUser')";
  mysqli_query($conexao, $query_insert_dist);
  header("location: distribuidora_audiovisual_cadastrar_form.php");

}
mysqli_close($conexao);
?>