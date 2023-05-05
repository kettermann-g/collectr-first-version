<?php
// ------------------------------ INICIO verificação sessão
// Iniciando a sessão
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_cache_expire(30); // Definindo o prazo para expirar a sessão em 30 minutos
	session_start();
  $userSessao = $_SESSION['username'];
  $idUser = $_SESSION['iduser'];
}

// Verificar se sessão NÃO está autenticada.
if((!isset($_SESSION['username']) == true))
{
	echo "<br>Usuário não autenticado.";
	header('location:index.php'); // redirecionar página
	exit(); // parar a execução do script porque a sessão não está autenticada
}
// ------------------------------ FIM verificação sessão


$nav = '<nav class="navbar navbar-expand-sm navbar-dark bg-black bg-gradient fixed-top">
<div class="container">
  <a href="homepage.php" class="navbar-brand mb-0 h1">
    Collectr
  </a>
  <button
  type="button"
  data-bs-toggle="collapse"
  data-bs-target="#navbarNav"
  class="navbar-toggler"
  aria-controls="navbarNav"
  aria-expanded="false"
  aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle active"
        id="navbarDropdown1" role="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        >
          Música
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
          <li><a href="navegar_obra_musica.php" class="dropdown-item">Nav. Obras Cadastradas</a></li>
          <li><a href="colecao_musica.php" class="dropdown-item">Ver Coleção</a></li>
          <li>
            <a href="#" class="dropdown-item">
              Cadastrar &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
              <li><a href="artista_musica_cadastrar_form.php" class="dropdown-item">Artista</a></li>
              <li><a href="obra_musica_cadastrar_form.php" class="dropdown-item">Obra</a></li>
              <li><a href="gravadora_musica_cadastrar_form.php" class="dropdown-item">Gravadora</a></li>
            </ul>
          </li>
          
        </ul>
      </li>
      <li class="nav-item active">
        <a href="#" class="nav-link dropdown-toggle active"
        id="navbarDropdown2" role="button"
        data-bs-toggle="dropdown"
        aria-expanded="false">
          Audiovisual
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
          <li><a href="navegar_obra_audiovisual.php" class="dropdown-item">Nav. Obras Cadastradas</a></li>
          <li><a href="colecao_audiovisual.php" class="dropdown-item">Ver Coleção</a></li>
          <li>
            <a href="#" class="dropdown-item">
              Cadastrar &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
              <li><a href="diretor_audiovisual_cadastrar_form.php" class="dropdown-item">Diretor</a></li>
              <li><a href="roteirista_audiovisual_cadastrar_form.php" class="dropdown-item">Roteirista</a></li>
              <li><a href="distribuidora_audiovisual_cadastrar_form.php" class="dropdown-item">Distribuidora</a></li>
              <li><a href="obra_audiovisual_cadastrar_form.php" class="dropdown-item">Obra</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="nav-item active">
        <a href="#" class="nav-link dropdown-toggle active"
        id="navbarDropdown3" role="button"
        data-bs-toggle="dropdown"
        aria-expanded="false">
          Visual
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
          <li><a href="navegar_obra_visual.php" class="dropdown-item">Nav. Obras Cadastradas</a></li>
          <li><a href="colecao_visual.php" class="dropdown-item">Ver Coleção</a></li>
          <li>
            <a href="" class="dropdown-item">
              Cadastrar &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
              <li><a href="artista_visual_cadastrar_form.php" class="dropdown-item">Artista</a></li>
              <li><a href="obra_visual_cadastrar_form.php" class="dropdown-item">Obra</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>
  <div>
  <ul class="navbar-nav">
  <li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle active" role="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
    id="navbarLinkPerfil" role="button" style="color: white;">'.$userSessao.'</a>
    <ul class="dropdown-menu dropdown-submenu">
      <li><a href="perfil.php?username='.$userSessao.'&iduser='.$idUser.'" class="dropdown-item">Meu Perfil</a></li>
      <li><a href="sair.php" class="dropdown-item">Sair</a></li>
    </ul>
  </li>
</ul>
  </div>
</div>
</nav>';


?>