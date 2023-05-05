<?php

include('configConex.php');
session_start();
$userSessao = $_SESSION['username'];

$idUser = $_SESSION['iduser'];


if(isset($_POST['salvar_colec'])) {
    $obra = $_POST['check'];
    foreach($obra as $item) { 
        $query_colec_mu = "INSERT INTO colecmu (idObMuColec, idUserAdq, dataAdqObraMu) VALUES ('$item', '$idUser', NOW())";
        mysqli_query($conexao, $query_colec_mu);
        
    }
    header("location: colecao_musica.php");

echo "<a href='homepage.php'>Homepage</a>";

}
else {
  echo "ERRO";
}

mysqli_close($conexao);
?>