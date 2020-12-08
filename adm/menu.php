<!-- Sidebar -->
<div class="adminx-sidebar expand-hover push">
  <ul class="sidebar-nav">
    <li class="sidebar-nav-item">
      <a href="<?php echo $value['conf_link'] ?>adm/dashboard" class="sidebar-nav-link">
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
      <a href="<?php echo $value['conf_link'] ?>adm/configuracoes/empresa" class="sidebar-nav-link">
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

    <li class="sidebar-nav-item">
      <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#navModulos" aria-expanded="false" aria-controls="navTables">
        <span class="sidebar-nav-icon">
          <i data-feather="codesandbox" class="nav-collapse-icon"></i>
        </span>
        <span class="sidebar-nav-name">
          Módulos
        </span>
        <span class="sidebar-nav-end">
            <i data-feather="chevron-right" class="nav-collapse-icon"></i>
          </span>
      </a>
      <ul class="sidebar-sub-nav collapse" id="navModulos">

        <?php 
          $lista = $pdo->query("SELECT * FROM modulos WHERE mod_status = 1 ORDER BY mod_ordem ASC")->fetchAll(PDO::FETCH_ASSOC);
          foreach($lista as $listValue){ 
        ?>

        <li class="sidebar-nav-item">
          <a href="<?php echo $value['conf_link'] ?>adm/<?php echo $listValue['mod_url'] ?>" class="sidebar-nav-link">
            <span class="sidebar-nav-icon">
              <i data-feather="<?php echo $listValue['mod_icone'] ?>"></i>
            </span>
            <span class="sidebar-nav-name">
              <?php echo $listValue['mod_titulo'] ?>
            </span>
            <span class="sidebar-nav-end">
            </span>
          </a>
        </li>

    <?php }  ?>

    </ul>
    </li>

    <?php

        $contato = $pdo->query("SELECT * FROM contatos WHERE cont_visualizado = 0")->fetchAll(PDO::FETCH_ASSOC);
        $quantidade = count($contato);
      
    ?>
    <li class="sidebar-nav-item">
      <a href="<?php echo $value['conf_link'] ?>adm/contato/" class="sidebar-nav-link">
        <span class="sidebar-nav-icon">
          <i data-feather="message-square"></i>
        </span>
        <span class="sidebar-nav-name">
          Mensagens 
        </span>
        <span class="sidebar-nav-end">
          <?= $quantidade == 0 ? '' : '<span class="badge badge-danger">'. $quantidade .'</span>' ?>
        </span>
      </a>
    </li>

    <li class="sidebar-nav-item">
      <a href="<?php echo $value['conf_link'] ?>adm/modulos/usuarios/listarUsuarios" class="sidebar-nav-link">
        <span class="sidebar-nav-icon">
          <i data-feather="user"></i>
        </span>
        <span class="sidebar-nav-name">
          Usuários
        </span>
        <span class="sidebar-nav-end">
        </span>
      </a>
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
            <a href="<?php echo $value['conf_link'] ?>adm/configuracoes/" class="sidebar-nav-link">
              <span class="sidebar-nav-abbr">
                <i data-feather="sliders"></i>
              </span>
              <span class="sidebar-nav-name">
                Ativar/Desativar Módulos
              </span>
            </a>
          </li>
          <li class="sidebar-nav-item">
            <a href="<?php echo $value['conf_link'] ?>adm/configuracoes/listarModulos" class="sidebar-nav-link">
              <span class="sidebar-nav-abbr">
                <i data-feather="codesandbox"></i>
              </span>
              <span class="sidebar-nav-name">
                Gerenciar Módulos
              </span>
            </a>
          </li>
          <li class="sidebar-nav-item">
            <a href="<?php echo $value['conf_link'] ?>adm/modulos/categorias/listarCategorias" class="sidebar-nav-link">
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