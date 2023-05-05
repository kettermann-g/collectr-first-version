<?php

include("configConex.php");
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

if(isset($_POST['btnExcluir'])) {
  $nomeArtista = $_POST['nomeartista'];
  $idArtista = $_POST['btnExcluir'];
  $query_excluir_artista_musica = "DELETE FROM artistamu WHERE idArMu = $idArtista AND nomeArMu = '$nomeArtista'";
  echo $query_excluir_artista_musica."<br>";

  if (mysqli_query($conexao, $query_excluir_artista_musica)) { //DELETOU ARTISTA?
    echo "Artista excluído"."<br>";
    header("location: artista_musica_cadastrar_form.php");
  } else { //NÃO DELETOU?
    //DETELANDO OBRA
    echo "Não excluiu <br>";
    $query_excluir_obras_artista = "DELETE FROM obramu WHERE idArMu = $idArtista";
    echo $query_excluir_obras_artista."<br>";
    if (mysqli_query($conexao, $query_excluir_obras_artista)) {//DELETOU OBRA?
      echo "excluiu <br>";
      //DELETANDO ARTISTA
      echo "DELETANDO ARTISTA <br>";
      mysqli_query($conexao, $query_excluir_artista_musica);
      header("location: artista_musica_cadastrar_form.php");
    } else {//NÃO DELETOU OBRA?
      //SELECIONAR OBRAS COM ID DO ARTISTA
      $query_descobrir_obras_artista = "SELECT IDobm FROM obramu WHERE idArMu = $idArtista";
      $res_obras_artista = mysqli_query($conexao, $query_descobrir_obras_artista);
      
      echo "DELETANDO DAS COLEÇÕES <br>";
      while($obras_artista = mysqli_fetch_assoc($res_obras_artista)) {
        $idObra = $obras_artista['IDobm'];
        echo $idObra."<br>";
        $query_deletar_colecao_artista = "DELETE FROM colecmu WHERE idObMuColec = $idObra";
        echo $query_deletar_colecao_artista."<br>";
        mysqli_query($conexao, $query_deletar_colecao_artista);
      }//FIM WHILE DELETANDO OBRAS DAS COLECOES
      //DELETANDO OBRAS
      echo "DELETANDO OBRAS <br>";
      mysqli_query($conexao, $query_excluir_obras_artista);   
      //DELETANDO ARTISTA
      echo "DELETANDO ARTISTAS <br>";
      mysqli_query($conexao, $query_excluir_artista_musica);
      header("location: artista_musica_cadastrar_form.php"); 
    }//FIM ELSE "NÃO DELETOU OBRA?"
  }//FIM ELSE NAO DELETOU ARTISTA DA BASE DE DADOS
}//FIM IF ISSET 
else {
  $nomeArMusDigit = $_POST['nomeArMuDigit'];
  $tipoArMusSelec = $_POST['tipoArMuSelec'];
  $diaFormacNas = $_POST['diaFormacNasDigit'];
  $mesFormacNas = $_POST['mesFormacNasDigit'];
  $anoFormacNas = $_POST['anoFormacNasDigit'];
  $diaFimMorte = $_POST['diaFimMorte'];
  $mesFimMorte = $_POST['mesFimMorte'];
  $anoFimMorte = $_POST['anoFimMorte'];
  
  $query_insert_arMu = "INSERT INTO artistamu (nomeArMu, tipoArMu, diaFormacNas, mesFormacNas, anoFormacNas, diaFimMorte, mesFimMorte, anoFimMorte, addUserArMu) VALUES ('$nomeArMusDigit', '$tipoArMusSelec', NULLIF('$diaFormacNas', ''), NULLIF('$mesFormacNas', ''), NULLIF('$anoFormacNas', ''), NULLIF('$diaFimMorte', ''), NULLIF('$mesFimMorte', ''), NULLIF('$anoFimMorte', ''), '$idUser') ";
  mysqli_query($conexao, $query_insert_arMu);
  echo "Log realizado com sucesso <br>";
  header("location: artista_musica_cadastrar_form.php");
  
}
mysqli_close($conexao);
?>