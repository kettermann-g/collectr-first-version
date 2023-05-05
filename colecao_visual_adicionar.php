<?php

include('configConex.php');
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];


if(isset($_POST['salvar_colecVi'])) {
  $obra = $_POST['check'];
  foreach($obra as $item) { 
    $query_colec_vi = "INSERT INTO colecvi (idObVi, idUserAdqVi, dataAdqObraVi) VALUES ('$item', '$idUser', NOW())";
    if(mysqli_query($conexao, $query_colec_vi)) {
      header('Location: colecao_visual.php');
    }
    else {
      echo "erro";
    }
  }

//echo '<pre>'; print_r($obra); echo '</pre>';

//header("Location: verColecVi.php");
//die();

}

mysqli_close($conexao);
?>