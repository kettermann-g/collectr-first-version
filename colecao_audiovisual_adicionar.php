<?php

include('configConex.php');
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];


if(isset($_POST['salvar_colec'])) {
    $obra = $_POST['check'];
    foreach($obra as $item) { 
        $query_colec_av = "INSERT INTO colecav (idObAvColec, idUserAdqAv, dataAdqObraAv) VALUES ('$item', '$idUser', NOW())";
        if(mysqli_query($conexao, $query_colec_av)) {
          header('Location: colecao_audiovisual.php');
        }
        else {
          echo "erro";
        }

    }

echo "<a href='homepage.php'>Homepage</a>";
}

mysqli_close($conexao);
?>