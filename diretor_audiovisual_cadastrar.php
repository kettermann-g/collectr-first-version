<?php

include ("configConex.php");
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

if(isset($_POST['btnExcluir'])) {
  $nomeDir = $_POST['nomediretor'];
  $idDiretor = $_POST['btnExcluir'];

  echo $nomeDir."<br>";
  echo $idDiretor."<br>";

  $query_excluir_diretor_audiovisual = "DELETE FROM diretorav WHERE idDirAv = $idDiretor AND nomeDirAv = '$nomeDir'";
  echo $query_excluir_diretor_audiovisual."<br>";

  if (mysqli_query($conexao, $query_excluir_diretor_audiovisual)) { //DELETOU GRAVADORA?
    echo "EXCLUIU"."<br>";
    header("location: diretor_audiovisual_cadastrar_form");
  } else { //NÃO DELETOU?
    //DETELANDO OBRA
    echo "NÃO EXCLUIU <br>";
    $query_excluir_obras_diretor = "DELETE FROM obraav WHERE idDirAv = $idDiretor";
    echo $query_excluir_obras_diretor."<br>";
    if (mysqli_query($conexao, $query_excluir_obras_diretor)) {//DELETOU OBRA?
      echo "excluiu <br>";
      //DELETANDO GRAVADORA
      echo "DELETANDO GRAVADORA <br>";
      mysqli_query($conexao, $query_excluir_diretor_audiovisual);
      header("location: diretor_audiovisual_cadastrar_form");
    } else {//NÃO DELETOU OBRA?
      //SELECIONAR OBRAS COM ID DA GRAVADORA
      $query_descobrir_obras_diretor = "SELECT idObAv FROM obraav WHERE idDirAv = $idDiretor";
      $res_obras_diretor = mysqli_query($conexao, $query_descobrir_obras_diretor);
      
      echo "DELETANDO DAS COLEÇÕES <br>";
      while($obras_diretor = mysqli_fetch_assoc($res_obras_diretor)) {
        $idObra = $obras_diretor['idObAv'];
        echo $idObra."<br>";
        $query_deletar_colecao_diretor = "DELETE FROM colecav WHERE idObAvColec = $idObra";
        echo $query_deletar_colecao_diretor."<br>";
        mysqli_query($conexao, $query_deletar_colecao_diretor);
      }//FIM WHILE DELETANDO OBRAS DAS COLECOES
      //DELETANDO OBRAS
      echo "DELETANDO OBRAS <br>";
      mysqli_query($conexao, $query_excluir_obras_diretor);   
      //DELETANDO ARTISTA
      echo "DELETANDO ARTISTAS <br>";
      mysqli_query($conexao, $query_excluir_diretor_audiovisual);
      header("location: diretor_audiovisual_cadastrar_form"); 
    }//FIM ELSE "NÃO DELETOU OBRA?"
  }//FIM ELSE NAO DELETOU ARTISTA DA BASE DE DADOS

}
else {
  $nomeDirDigit = $_POST['nomeDirDigit'];
  $diaNasc = $_POST['diaNasc'];
  $mesNasc = $_POST['mesNasc'];
  $anoNasc = $_POST['anoNasc'];
  $diaFalec = $_POST['diaFalec'];
  $mesFalec = $_POST['mesFalec'];
  $anoFalec = $_POST['anoFalec'];

  $query_insert_dirAv = "INSERT INTO diretorav (nomeDirAv, diaNascDirAv, mesNascDirAv, anoNascDirAv, diaFalecDirAv, mesFalecDirAv, anoFalecDirAv, addUserDirAv) VALUES ('$nomeDirDigit', NULLIF('$diaNasc', ''), NULLIF('$mesNasc', ''), NULLIF('$anoNasc', ''), NULLIF('$diaFalec', ''), NULLIF('$mesFalec', ''), NULLIF('$anoFalec', ''), '$idUser') ";
  mysqli_query($conexao, $query_insert_dirAv);
  echo "fjisdighdfiughs";
  header("location: diretor_audiovisual_cadastrar_form.php");

}

mysqli_close($conexao);
?>