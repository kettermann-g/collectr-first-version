<?php
include("navbar.php");
include("configConex.php");
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

$id_user_seguido_ck = $_COOKIE['cookie_id_seguido'];
$username_seguido_ck = $_COOKIE['cookie_username_seguido'];
$op_relacao = $_COOKIE['op'];

echo $op_relacao."<br>";

if($op_relacao == 1) {
  

  $query_seguir = "INSERT INTO vinculo (idUsuario, idUsuarioSeguido) VALUES ($idUser, $id_user_seguido_ck)";
  
  echo $query_seguir."<br>";

  if(mysqli_query($conexao, $query_seguir)) {
    echo $userSessao." ESTÁ SEGUINDO ".$username_seguido_ck."<br>";
    header("Location: perfil.php?username=$username_seguido_ck&iduser=$id_user_seguido_ck");
    exit;
  }
  else {
    echo "ERRO!!!!!!!";
  }
}
else if($op_relacao == 2){
  $query_remove_seguir = "DELETE FROM vinculo WHERE idUsuario = $idUser  AND idUsuarioSeguido = $id_user_seguido_ck";
  
  echo $query_remove_seguir."<br>";

  if(mysqli_query($conexao, $query_remove_seguir)) {
    echo $userSessao." DEIXOU DE SEGUIR ".$username_seguido_ck."<br>";
    header("Location: perfil.php?username=$username_seguido_ck&iduser=$id_user_seguido_ck");
    exit;
  }
  else {
    echo "ERRO!!!!!!!";
  }
}
else {
  echo "ERRO!!!!!";
}



mysqli_close($conexao);

?>