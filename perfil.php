<?php
include("configConex.php");
include("navbar.php");
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];


if(isset($_GET['username']) && isset($_GET['iduser'])) {
  $nome = $_GET['username'];
  $id = $_GET['iduser'];

  //SELECIONANDO OBRAS AUDIOVISUAIS
  $query_perfil_user = "SELECT iduser, username, displayname FROM usuarios WHERE iduser = $id AND username = '$nome' LIMIT 1";

  $query_obras_colec_av = "SELECT c.idPecAv, c.idObAvColec, o.tituloObAv, o.codBarAv, d.nomeDirAv, r.nomeRotAv, f.nomeFormatoAv, dis.nomeDistAv, o.diaLancAv, o.mesLancAv, o.anoLancAv, u.username AS nomeUser, c.dataAdqObraAv, o.imagemObAv
  FROM colecav AS c 
  INNER JOIN obraav AS o ON o.idObAv = c.idObAvColec 
  INNER JOIN diretorav AS d ON d.idDirAv = o.idDirAv
  INNER JOIN roteiristaav AS r ON r.idRotAv = o.idRotAv
  INNER JOIN formatoav AS f ON f.idFormatoAv = o.idFormatoAv
  INNER JOIN distribav AS dis ON dis.idDistAv = o.idDistAv
  INNER JOIN usuarios AS u ON u.iduser = o.addUserObAv
  WHERE c.idUserAdqAv = $id ORDER BY dataAdqObraAv DESC";
  $res_q_ob_av = mysqli_query($conexao, $query_obras_colec_av);

  //SELECIONANDO OBRAS VISUAIS
  $query_obras_colec_vi = "SELECT c.idPecVi, c.idObVi, o.tituloObVi, a.nomeArVi, t.nomeTipoVi, o.ano, o.imagemObVi, u.username as usuario, c.dataAdqObraVi
	FROM colecvi AS c 
	INNER JOIN obravi AS o ON o.idObVi = C.idObVi 
	INNER JOIN artistavi AS a ON a.idArVi = o.idArvi
	INNER JOIN tipoobravi AS t ON t.idTipoVi = o.idTipoVi
  INNER JOIN usuarios AS u ON o.addUserObVi = u.iduser
	WHERE c.idUserAdqVi = $id ORDER BY dataAdqObraVi desc";
  $res_q_ob_vi = mysqli_query($conexao, $query_obras_colec_vi);

  //SELECIONANDO OBRAS DE MUSICA
  $query_obras_colec_mu = "SELECT c.idPecMu , c.idObMuColec, o.tituloObMu, a.nomeArMu, f.NomeFormato, t.nomeTipoMu, o.codBarMu, g.nomeGravMu, o.diaLancObMu, o.mesLancObMu, o.anoLancObMu, u.username, o.imagemObMu, c.dataAdqObraMu
	FROM colecmu AS c 
	INNER JOIN obramu AS o ON o.IDobm = c.idObMuColec 
	INNER JOIN artistamu AS a ON a.idArMu = o.idArMu
	INNER JOIN formatomu AS f ON f.IDformatoMu = o.IDformatoMu
  INNER JOIN usuarios AS u ON u.iduser = o.addUserObMu
    INNER JOIN tipoobramu AS t ON t.IDtipoMu = o.IDtipoMu
    INNER JOIN gravadoramu AS g ON g.idGravMu = o.labelMu
	WHERE c.idUserAdq = $id";
$res_q_ob_mu = mysqli_query($conexao, $query_obras_colec_mu);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" href="estilonavbar.css">

  <style>
    .col-3 {
      text-align: center;
    }
    th, td {
      max-width: 200px!important;
    }
    
    
  </style>
  <script src="filtrar.js"></script>
</head>
<body>
  <?php echo $nav; ?>
  <!-- CHECANDO VALIDEZ DA URL -->
  <div class="shadow container pt-5" id="container-perfil">
    <div id="info" class="row">
      <div id="infoUser" class="col-6">

        <?php
        // --------------------------- MOSTRAR NOME DO PERFIL
        //GET USERNAME OU ID INEXISTENTE - DIE NA PAGINA - URL INVALIDA - NAO RODA MAIS NENHUM CODIGO
        if(!isset($_GET['username']) || !isset($_GET['iduser'])) { //INICIO GET FALTA VARIAVEL
          echo "<h1 class='display-1'>URL de perfil inválida</h1>";
          echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
            </body>
            </html>';
            die();
        }//FIM GET FALTA VARIAVEL
        else { //GET USERNAME E ID EXISTENTE
          $result_perfil = mysqli_query($conexao, $query_perfil_user);
          if ($result_perfil) { // QUERY FOI EXECUTADA COM SUCESSO
            if (mysqli_num_rows($result_perfil)) { //EXISTEM LINHAS DE RESULTADO
              $dadosUser = mysqli_fetch_assoc($result_perfil);
              $display = $dadosUser['displayname'];
              $username = $dadosUser['username'];
              if(!$dadosUser['displayname']) { //NOME DE DISPLAY NULO NA DATABASE
                echo "<h1 class='display-1'>$username</h1>"; 
              }// FIM NOME DE DISPLAY NULO NA DATABASE
              else { //TEM NOME DE DISPLAY *E* USERNAME
                echo "<h1 class='display-1'>$display</h1>";
                echo "<h2 class='display-6'>$username</h2>";
              }// FIM ELSE RETORNA NOME DE DISPLAY *E* USERNAME 
              
            }
            else { // GET USERNAME E ID EXISTE - REGISTRO NAO EXISTE NA DATABASE
              echo "<h1 class='display-1'>Usuário não encontrado</h1>";
              echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
              </body>
              </html>';
              die();
            } //FIM GET USERNAME E ID EXISTE - REGISTRO NAO EXISTE NA DATABASE
          }
          else { // QUERY SELECT NÃO FOI EXECUTADA COM SUCESSO
          echo "<h1 class='display-1'>URL de perfil inválida</h1>";
          echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
            </body>
            </html>';
            die();
          }// FIM QUERY SELECT NÃO FOI EXECUTADA COM SUCESSO
          

        }// FIM GET USERNAME E ID EXISTENTE
          
        //

        ?>
      </div>
      <!-- SEÇAO DE SEGUINDO E SEGUIDORES -->
      <div id="infoSeguindo" class="col-3">
        <?php 
          $query_qnt_seguindo = "SELECT COUNT(idUsuarioSeguido) as seguindo FROM vinculo WHERE idUsuario = $id";
          $res_qnt_seguindo = mysqli_query($conexao, $query_qnt_seguindo);
          $dados_qnt_seguindo = mysqli_fetch_assoc($res_qnt_seguindo);
          $qnt_seguindo = $dados_qnt_seguindo['seguindo'];
          echo "<h1 class='display-1 numSeg'>$qnt_seguindo<h1>";
        ?>
        <a class="numSeg btn btn-lg shadow" data-bs-toggle="modal" data-bs-target="#modalSeguindo">Seguindo</a>


      </div>
      <div id="infoseguidores" class="col-3"> 
        <?php
          $query_qnt_seguidores = "SELECT COUNT(idUsuario) as seguidores FROM vinculo WHERE idUsuarioSeguido = $id";
          $res_qnt_seguidores = mysqli_query($conexao, $query_qnt_seguidores);
          $dados_qnt_seguidores = mysqli_fetch_assoc($res_qnt_seguidores);
          $qnt_seguidores = $dados_qnt_seguidores['seguidores'];
          echo "<h1 class='display-1 numSeg'>$qnt_seguidores<h1>";
        ?>
        
        <a class="numSeg btn btn-lg shadow" data-bs-toggle="modal" data-bs-target="#modalSeguidores">Seguidores</a>
      </div>
     
    <h1 class="display-6" style="margin-top: 2rem;">Pesquisar por usuários:</h1>
    <div class="row">
      <div class="col-6" id="divProcurarUser">
        <form action="pesquisa_user.php" class="d-flex" role="search" method="get">
          <input class="form-control me-2 shadow" type="text" name="pesqUser" id="pesqUser" placeholder="Digite o username aqui" aria-label="Procurar">
          <button class="btn btn-outline-success" type="submit">Procurar</button>
        </form>
      </div>
      <div class="col-6" style="text-align: center;">
        <!-- ------------BOTAO SEGUIR---------- -->
        <?php
          if($userSessao != $_GET['username']) {
            $query_checa_segue = "SELECT idVinculo FROM vinculo WHERE idUsuario = $idUser AND idUsuarioSeguido = $id LIMIT 1"; //PESQUISA SE EXISTE VINCULO ENTRE USUARIO DA SESSAO (ACESSANDO A PAGINA DO USUARIO) E USUARIO SENDO ACESSADO
            $res_vinculo = mysqli_query($conexao, $query_checa_segue);
            if (mysqli_num_rows($res_vinculo) == 0) {
              echo "<button onclick='seguir()' class='btn btn-success shadow' id='seguir' name='seguir'>Seguir</button>";
            }
            else {
              echo "<button onclick='rmv()' class='btn btn-danger shadow' id='rmv' name='rmv'>Deixar de seguir</button>";
            }
            
            
          }
        
        ?>
      </div>
    </div>

    </div>
    
    <h1 class="display-1" style="margin-top: 2rem;">Coleção:</h1>

    <h2 class="display-6">Música</h2>
    <table class="table table-striped tabela-obras" id="tabelaMu">
      <thead>
        <tr>
          <th></th>
          <th>&nbsp#&nbsp</th>
          <th>ID da Obra</th>
          <th>Título</th>
          <th>Artista</th>
          <th>Formato</th>
          <th>Tipo</th>
          <th>Código de Barras</th>
          <th>Label</th>
          <th>Lançamento</th>
          <th>Obtido em:</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $contador = 0;
          while($dados_tabela_colec_mu = mysqli_fetch_array($res_q_ob_mu)) {
            $imagem = $dados_tabela_colec_mu['imagemObMu'];
            $contador++;
            $dia = $dados_tabela_colec_mu['diaLancObMu'];
            $mes = $dados_tabela_colec_mu['mesLancObMu'];
            $ano = $dados_tabela_colec_mu['anoLancObMu'];
            switch (strlen($dia)) {
              case 1:
                $dia = "0".$dia;
                break;
              case 0:
                $dia = "??";
                break;
            }
            switch (strlen($mes)) {
              case 1:
                $mes = "0".$mes;
                break;
              case 0:
                $mes = "??";
                break;
            }
            if (strlen($ano) == 0) {
              $ano = "????";
            }
            $data_lanc = $dia."/".$mes."/".$ano;
            echo "<tr>";
            
            switch (strlen($imagem)) {
              case 0:
                echo "<td></td>";
                break;
              case strlen($imagem)>0:
                echo "<td style='width: 200px; height: 200px;'><img style='height: 170px; width: auto;' src='imagens/$imagem' alt=''>";
            }
            echo "<td>".$contador."</td>";
            echo "<td>".$dados_tabela_colec_mu['idObMuColec']."</td>";
            echo "<td>".$dados_tabela_colec_mu['tituloObMu']."</td>";
            echo "<td>".$dados_tabela_colec_mu['nomeArMu']."</td>";
            echo "<td>".$dados_tabela_colec_mu['NomeFormato']."</td>";
            echo "<td>".$dados_tabela_colec_mu['nomeTipoMu']."</td>";
            echo "<td>".$dados_tabela_colec_mu['codBarMu']."</td>";
            echo "<td>".$dados_tabela_colec_mu['nomeGravMu']."</td>";
            echo "<td>".$data_lanc."</td>";
            echo "<td>".$dados_tabela_colec_mu['dataAdqObraMu'];
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>

    <h2 class="display-6">Audiovisual</h2>
    <table class="table table-striped" id="tabelaAv">
      <thead>
        <tr>
          <th></th>
          <th>&nbsp#&nbsp</th>
          <th>ID da Obra</th>
          <th>Título</th>
          <th>Código de Barras</th>
          <th>Diretor</th>
          <th>Roteirista</th>
          <th>Formato</th>
          <th>Distribuidora</th>
          <th>Lançamento</th>
          <th>Obtido em:</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $contador = 0;
        while($dados_tabela_colec_av = mysqli_fetch_array($res_q_ob_av)) {
          $imagem = $dados_tabela_colec_av['imagemObAv'];
          $contador++; // incrementa a variável contador em 1
          $dia = $dados_tabela_colec_av['diaLancAv'];
          $mes = $dados_tabela_colec_av['mesLancAv'];
          $ano = $dados_tabela_colec_av['anoLancAv'];

          $datas = array($dia, $mes);
          switch (strlen($dia)) {
            case 1:
              $dia = "0".$dia;
              break;
            case 0:
              $dia = "??";
              break;
          }
          switch (strlen($mes)) {
            case 1:
              $mes = "0".$mes;
              break;
            case 0:
              $mes = "??";
              break;
          }

          $data_lanc = $dia."/".$mes."/".$ano;
          echo "<tr>";
          
          switch (strlen($imagem)) {
            case 0:
              echo "<td></td>";
              break;
            case strlen($imagem)>0:
              echo "<td style='width: 170px; height: 200px;'><img style='height: 170px; width: auto;' src='imagens/$imagem' alt=''>";
          }
          echo "<td>".$contador."</td>";
          echo "<td>".$dados_tabela_colec_av['idObAvColec']."</td>";
          
          echo "<td>".$dados_tabela_colec_av['tituloObAv']."</td>";
          echo "<td>".$dados_tabela_colec_av['codBarAv']."</td>";
          echo "<td>".$dados_tabela_colec_av['nomeDirAv']."</td>";
          echo "<td>".$dados_tabela_colec_av['nomeRotAv']."</td>";
          echo "<td>".$dados_tabela_colec_av['nomeFormatoAv']."</td>";
          echo "<td>".$dados_tabela_colec_av['nomeDistAv']."</td>";
          echo "<td>".$data_lanc."</td>";
          
          echo "<td>".$dados_tabela_colec_av['dataAdqObraAv']."</td>";
          echo "</tr>";
        }
      ?>

      </tbody>
    </table>

    <h2 class="display-6">Visual</h2>
    <table class="table table-striped" id="tabelaVisual">
      <thead>
        <tr>
          <th></th>
          <th>&nbsp#&nbsp</th>
          <th>ID da obra</th>
          <th>Título</th>
          <th>Artista</th>
          <th>Tipo</th>
          <th>Ano</th>
          <th>Obtido em:</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $contador = 0;
          while($dados_tabela_colec_vi = mysqli_fetch_array($res_q_ob_vi)) {
            $imagem = $dados_tabela_colec_vi['imagemObVi'];
            $contador++; // incrementa a variável contador em 1
            echo "<tr>"; // inicia linha html
            
            switch (strlen($imagem)) {
              case 0:
                echo "<td></td>";
                break;
              case strlen($imagem)>0:
                echo "<td style='width: 200px; height: 200px;'><img style='height: 170px; width: auto;' src='imagens/$imagem' alt=''>";
            }
            echo "<td>".$contador."</td>";
            echo "<td>".$dados_tabela_colec_vi['idObVi']."</td>";
            echo "<td>".$dados_tabela_colec_vi['tituloObVi']."</td>";
            echo "<td>".$dados_tabela_colec_vi['nomeArVi']."</td>";
            echo "<td>".$dados_tabela_colec_vi['nomeTipoVi']."</td>";
            echo "<td>".$dados_tabela_colec_vi['ano']."</td>";
            
            echo "<td>".$dados_tabela_colec_vi['dataAdqObraVi']."</td>";
            echo "</tr>";
          }
          
        ?>
      </tbody>
    </table>
  </div>


  <!-- MODAL SEGUINDO -->
  <div class="modal fade" id="modalSeguindo" tabindex="-1" aria-labelledby="SeguindoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="SeguindoModalLabel">Seguindo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <input onkeyup="filtrar('pesqFiltrar', 'tabelaFiltrar')" type="text" name="pesqFiltrar" id="pesqFiltrar" class="form-control" placeholder="Filtrar">
          <table class="table table-striped" id="tabelaFiltrar">
            <thead>
              <tr>
                <th>Username</th>
                <th>Nome</th>
                <th>ID</th>
              </tr>
            </thead>
              <tbody>
                <?php
                  $query_lista_seguindo = "SELECT usuarios.username as usernameSeguindo, idUsuarioSeguido, usuarios.displayname as displaySeguindo FROM vinculo INNER JOIN usuarios ON usuarios.iduser = vinculo.idUsuarioSeguido WHERE idUsuario = $id";
                  $res_lista_seguindo = mysqli_query($conexao, $query_lista_seguindo);
                  if(mysqli_num_rows($res_lista_seguindo)) {
                    while ($dados_lista_seguindo = mysqli_fetch_assoc($res_lista_seguindo)) {
                      $username_lista_seguindo = $dados_lista_seguindo['usernameSeguindo'];
                      $idSeguindo = $dados_lista_seguindo['idUsuarioSeguido'];
                      $display_seguindo = $dados_lista_seguindo['displaySeguindo'];
                      echo "<tr>";
                      echo "<td><a style='background-color:inherit!important;' href='perfil.php?username=$username_lista_seguindo&iduser=$idSeguindo'>$username_lista_seguindo</a></td>";

                      echo "<td>$display_seguindo</td>";
                      echo "<td>$idSeguindo</td>";
                      echo "</tr>";
                    }
                  }
                ?>
              </tbody>
          </table>

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL SEGUIDORES -->
  <div class="modal fade" id="modalSeguidores" tabindex="-1" aria-labelledby="seguidoresModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="seguidoresModalLabel">Seguidores</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <input onkeyup="filtrar('pesqFiltrar2', 'tabelaFiltrar2')" type="text" name="pesqFiltrar" id="pesqFiltrar2" class="form-control" placeholder="Filtrar">
          <table class="table table-striped" id="tabelaFiltrar2">
            <thead>
              <tr>
                <th>Username</th>
                <th>Nome</th>
                <th>ID</th>
              </tr>
            </thead>
              <tbody>
                <?php
                  $query_lista_seguidores = "SELECT usuarios.username AS usernameSeguidor, idUsuario, usuarios.displayname AS displaySeguidor FROM vinculo
                  INNER JOIN usuarios ON usuarios.iduser = vinculo.idUsuario
                  WHERE idUsuarioSeguido = $id";
                  $res_lista_seguidoes = mysqli_query($conexao, $query_lista_seguidores);
                  if(mysqli_num_rows($res_lista_seguidoes)) {
                    while ($dados_lista_seguidores = mysqli_fetch_assoc($res_lista_seguidoes)) {
                      $username_lista_seguidores = $dados_lista_seguidores['usernameSeguidor'];
                      $idSeguidor = $dados_lista_seguidores['idUsuario'];
                      $display_seguidor = $dados_lista_seguidores['displaySeguidor'];
                      echo "<tr>";
                      echo "<td><a style='background-color:inherit!important;' href='perfil.php?username=$username_lista_seguidores&iduser=$idSeguidor'>$username_lista_seguidores</a></td>";

                      echo "<td>$display_seguidor</td>";
                      echo "<td>$idSeguidor</td>";
                      echo "</tr>";
                    }
                  }
                ?>
              </tbody>
          </table>

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

<script type="text/javascript">

  function seguir() {
    document.cookie = 'cookie_id_seguido = <?php echo $id; ?>';
    document.cookie = 'cookie_username_seguido = <?php echo $nome;?>';
    document.cookie = 'op = 1';
    

    window.location.href = "add_del_vinculo.php";
  }
  function rmv(){
    document.cookie = 'cookie_id_seguido = <?php echo $id; ?>';
    document.cookie = 'cookie_username_seguido = <?php echo $nome;?>';
    document.cookie = 'op = 2';
    
    window.location.href = "add_del_vinculo.php";
  }
  

</script>

<?php mysqli_close($conexao); ?>