

<!-- Sidebar -->
<div class="adminx-sidebar expand-hover push">
  <ul class="sidebar-nav">
    <li class="sidebar-nav-item">
      <a href="dashboard" class="sidebar-nav-link active">
        <span class="sidebar-nav-icon">
          <i data-feather="home"></i>
        </span>
        <span class="sidebar-nav-name">
          Painel de Controle
        </span>
        <span class="sidebar-nav-end">

        </span>
      </a>
    </li>

    <li class="sidebar-nav-item">
      <a href="empresa" class="sidebar-nav-link">
        <span class="sidebar-nav-icon">
          <i data-feather="check-circle"></i>
        </span>
        <span class="sidebar-nav-name">
          Informações Empresa
        </span>
        <span class="sidebar-nav-end">
        </span>
      </a>
    </li>


    <?php 
      $lista = $pdo->query("SELECT * FROM MODULOS WHERE MOD_STATUS = 1 ORDER BY MOD_ORDEM ASC")->fetchAll(PDO::FETCH_ASSOC);
      foreach($lista as $listValue){ 
    ?>

    <li class="sidebar-nav-item">
        <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#nav_<?php echo $listValue['mod_id'] ?>" aria-expanded="false" aria-controls="navTables">
          <span class="sidebar-nav-icon">
            <i data-feather="<?php echo $listValue['mod_icone'] ?>"></i>
          </span>
          <span class="sidebar-nav-name">
            <?php echo $listValue['mod_titulo'] ?>
          </span>
          <span class="sidebar-nav-end">
            <i data-feather="chevron-right" class="nav-collapse-icon"></i>
          </span>
        </a>
        <ul class="sidebar-sub-nav collapse" id="nav_<?php echo $listValue['mod_id'] ?>">
          <li class="sidebar-nav-item">
            <a href="<?php echo $listValue['mod_url'] ?>" class="sidebar-nav-link">
              <span class="sidebar-nav-abbr">
                <i data-feather="list"></i>
              </span>
              <span class="sidebar-nav-name">
                Listar <?php echo $listValue['mod_titulo'] ?>
              </span>
            </a>
          </li>
        </ul>
      </li>

    <?php } ?>


    <li class="sidebar-nav-item">
      <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#navUsuario" aria-expanded="false" aria-controls="navTables">
        <span class="sidebar-nav-icon">
          <i data-feather="user"></i>
        </span>
        <span class="sidebar-nav-name">
          Usuários
        </span>
        <span class="sidebar-nav-end">
          <i data-feather="chevron-right" class="nav-collapse-icon"></i>
        </span>
      </a>
      <ul class="sidebar-sub-nav collapse" id="navUsuario">
        <li class="sidebar-nav-item">
          <a href="listarUsuarios" class="sidebar-nav-link">
            <span class="sidebar-nav-abbr">
              <i data-feather="list"></i>
            </span>
            <span class="sidebar-nav-name">
              Listar Usuários
            </span>
          </a>
        </li>
      </ul>
    </li>

    <?php if($_SESSION['nivel'] == 1){ ?>
    <li class="sidebar-nav-item">
      <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#navNumeros" aria-expanded="false" aria-controls="navTables">
        <span class="sidebar-nav-icon">
          <i data-feather="settings" class="nav-collapse-icon"></i>
        </span>
        <span class="sidebar-nav-name">
          Configurações
        </span>
        <span class="sidebar-nav-end">
            <i data-feather="chevron-right" class="nav-collapse-icon"></i>
          </span>
      </a>
      <ul class="sidebar-sub-nav collapse" id="navNumeros">
          <li class="sidebar-nav-item">
            <a href="configuracoes" class="sidebar-nav-link">
              <span class="sidebar-nav-abbr">
                <i data-feather="sliders"></i>
              </span>
              <span class="sidebar-nav-name">
                Configurações do Site
              </span>
            </a>
          </li>
          <li class="sidebar-nav-item">
            <a href="listarModulos" class="sidebar-nav-link">
              <span class="sidebar-nav-abbr">
                <i data-feather="codesandbox"></i>
              </span>
              <span class="sidebar-nav-name">
                Gerenciar Módulos
              </span>
            </a>
          </li>
          <li class="sidebar-nav-item">
            <a href="listarCategorias" class="sidebar-nav-link">
              <span class="sidebar-nav-abbr">
                <i data-feather="tag"></i>
              </span>
              <span class="sidebar-nav-name">
                Gerenciar Categorias
              </span>
            </a>
          </li>
        </ul>
    </li>
    <?php } ?>

  </ul>
</div><!-- Sidebar End -->