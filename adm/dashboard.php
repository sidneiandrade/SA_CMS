<?php

include 'system/conexao.php';
include 'header.php';

?>

<!-- adminx-content-aside -->
<div class="adminx-content">
  <div class="adminx-main-content">
    <div class="container-fluid">
      <!-- BreadCrumb -->
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb adminx-page-breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Painel de Controle</li>
        </ol>
      </nav>

      <div class="pt-4 pb-3">
        <h2>Bem-Vindo <?php echo $_SESSION['usuario'] ?></h2>
      </div>

      <div class="row">

      <?php 
        $dashboard = $pdo->query("SELECT * FROM modulos WHERE mod_status = 1 ORDER BY mod_ordem ASC")->fetchAll(PDO::FETCH_ASSOC);
        foreach($dashboard as $dashValue){ 
      ?>
        <div class="col-lg-2 col-sm-4 text-center mb-3">
          <div class="card">
            <a href="<?php echo $dashValue['mod_url'] ?>" style="cursor: pointer; text-decoration: none; color: #212529;">
              <div class="card-body collapse show" id="card1">
                <i data-feather="<?php echo $dashValue['mod_icone'] ?>" style="width: 40px; height: 40px"></i>
                <br>
                <small><?php echo $dashValue['mod_titulo'] ?></small>
              </div>
            </a>
          </div>
        </div>
      <?php } ?>

        <div class="col-lg-2 col-sm-4 text-center mb-3">
          <div class="card">
            <a href="listarUsuarios" style="cursor: pointer; text-decoration: none; color: #212529;">
              <div class="card-body collapse show" id="card1">
                <i data-feather="user" style="width: 40px; height: 40px"></i>
                <br>
                <small>Usuários</small>
              </div>
            </a>
          </div>
        </div>

        <?php if($_SESSION['nivel'] == 1){ ?>
        <div class="col-lg-2 col-sm-4 text-center mb-3">
          <div class="card">
            <a href="configuracoes" style="cursor: pointer; text-decoration: none; color: #212529;">
              <div class="card-body collapse show" id="card1">
                <i data-feather="settings" style="width: 40px; height: 40px"></i>
                <br>
                <small>Configurações</small>
              </div>
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>