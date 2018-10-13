<!-- Our Custom CSS -->
<link rel="stylesheet" href="css/sidebar.css">
<!-- Sidebar  -->
<nav id="sidebar">
  <div class="sidebar-header">
    <h3><?php
      echo "BEM-VINDO !";?></h3>
      <h6 style='text-align: center;'><?php echo "<br>";
      echo $_SESSION['nome_user']; 
    ?></h6>
  </div>
  <ul class="list-unstyled components">
    <li>
      <a href="page_user.php">
        <i class="fas fa-home"></i>
        Home
      </a>
    </li>
    <li>
      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-calendar-alt"></i>
        Eventos
      </a>
      <ul class="collapse list-unstyled" id="pageSubmenu">
        <li>
          <a href="inscricao_evento">Disponiveis</a>
        </li>
        <li>
          <a href="#">Encerrados</a>
        </li>
        <li>
          <a href="lista_de_coordenadores.php">Criar</a>
        </li>
        <li>
          <a href="meus_eventos.php">Meus Eventos</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#page2Submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-clipboard-list"></i>
        Atividades
      </a>
      <ul class="collapse list-unstyled" id="page2Submenu">
        <li>
          <a href="minhas_atividades.php">Minhas Atividades</a>
        </li>
        <li>
          <a href="lista_de_eventos.php">Criar</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#">
        <i class="fas fa-user"></i>
        Usuários
      </a>
    </li>
    <li>
      <a href="lista_de_trabalhos.php">
        <i class="fas fa-file"></i>
        Trabalhos
      </a>
    </li>
    <li>
      <a href="cadastro_de_ambientes.php">
        <i class="fas fa-map-marker-alt"></i>
        Ambientes
      </a>
    </li>
    <li>
      <a href="buscar_eventos_credenciamento.php">
         <i class="fas fa-id-badge"></i>
        Credenciamento
      </a>
    </li>
    <li>
      <a href="atividades_para_lista_frequencia.php">
         <i class="fas fa-clipboard-check"></i>
        Frequência
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fas fa-image"></i>
        Portifólio
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fas fa-question"></i>
        Perguntas frequentes
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fas fa-paper-plane"></i>
        Contatos
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fas fa-briefcase"></i>
        Sobre
      </a>
    </li>
  </ul>
</nav>
