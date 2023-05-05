<?php
include('configConex.php');
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

$valorTabela = $_POST['tabela'];
$botao = $_POST['btnsubmit'];
$idObra = $_POST['idOb'];

if (isset($botao)) {
  if (0 <= $valorTabela && $valorTabela <=2) {
    echo $valorTabela."<br>"; //ARRAYS BASEADOS NO INPUT HIDDEN
    $tabelas = ['obravi', 'obraav', 'obramu']; //TABELAS DE OBRAS
    $tabelasColec = ['colecvi', 'colecav', 'colecmu']; //TABELAS DE COLECOES
    $campoId = ['idObVi', 'idObAv', 'IDobm']; //TABELAS DE CAMPOS DE ID
    $campoIdColec = ['idObVi', 'idObAvColec', 'idObMuColec']; //CAMPOS ID COLEÇOES
    $paginas = ['navegar_obra_visual.php', 'navegar_obra_audiovisual.php', 'navegar_obra_musica.php'];
    
    //ECHO PRA TESTAR SE A VARIAVEL ESTÁ CERTA
    echo $tabelas[$valorTabela]."<br>"; 
    echo $campoId[$valorTabela]."<br>";
  
    $tabelaDelete = $tabelas[$valorTabela]; //TABELA DE OBRAS
    $campoDelete = $campoId[$valorTabela]; //CAMPO DE ID DA OBRA
    $paginaRedirect = $paginas[$valorTabela];
    
  
    echo $tabelaDelete."<br>"; // TABELA DE OBRA PRA SER DELETADA
    echo $campoDelete."<br>"; //TABELA DO CMAPO DE ID RESPECTIVO DA TABELA 
    echo $idObra."<br>"; // ID DA OBRA
    $query_del_obra_database = "DELETE FROM $tabelaDelete WHERE $campoDelete = $idObra"; // QUERY DELETE TABELAS DE OBRAS
    echo $query_del_obra_database."<br>"; // ECHO TESTE VERIFICAR QUERY COM VARIAVEIS
    //mysqli_query($conexao, $query_del_obra_database);
    if (mysqli_query($conexao, $query_del_obra_database)) { //SE DIRETO NENHUM USUARIO TIVER A OBRA NA COLEÇAO
      echo "Registro excluído com sucesso. ";
      header ("location: $paginaRedirect");
    } 
    else { //SE ALGUEM TIVER NA COLEÇÃO
      $tabelaDeleteColec = $tabelasColec[$valorTabela]; // SELECIONA TABELA DE COLECAO
      $campoDeleteColec = $campoIdColec[$valorTabela];
      $query_del_colec = "DELETE FROM $tabelaDeleteColec WHERE $campoDeleteColec = $idObra"; // QUERY DELETAR DA COLECAO DE TODOS OS USUARIOS
      echo $query_del_colec."<br>"; // ECHO VERIFICAR QUERY
      if (mysqli_query($conexao, $query_del_colec)) { // VERIFICA SE DELETOU DAS COLEÇOES
        $rows = mysqli_affected_rows($conexao);
        echo "OBRA DELETADA DA COLEÇÃO DE $rows USUÁRIO(S)<br>";
        if (mysqli_query($conexao, $query_del_obra_database)) {
          echo "OBRA DELETADA DA BASE DE DADOS COM SUCESSO<br>";
          header("Location: $paginaRedirect");
        }
        else {
          echo "ERRO: NÃO FOI POSSÍVEL DELETAR DA BASE DE DADOS<br>";
        }
      }
      else {
        echo "NÃO FOI POSSÍVEL DELETAR ESSA OBRA DA COLEÇÃO DOS USUÁRIOS<br>";
      }
    }
  }
  else {
    echo "ERRO!";
  }
}

mysqli_close($conexao);
?>