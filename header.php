<?php 

include 'adm/system/conexao.php';
include 'select.php';

$sql = $pdo->query("SELECT * FROM configuracoes")->fetchAll(PDO::FETCH_ASSOC);
foreach($sql as $values){}

$modulos = $pdo->prepare("SELECT * FROM modulos");
$modulos->execute();
$listModulos = $modulos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $values['conf_nome'] . ' - ' . $values['conf_descricao'] ?></title>
  
  <meta name="description" content="<?php echo $values['conf_descricao'] ?>">
  <meta name="author" content="<?php echo $values['conf_nome'] ?>">
  <meta name="keywords" content="">

  <!-- Facebook-->
  <meta property="og:locale" content="pt_BR">
  <meta property="og:url" content="<?php echo $baseUrl ?>"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="<?php echo $values['conf_nome'] ?>"/>
  <meta property="og:description" content="<?php echo $values['conf_descricao'] ?>"/> <!-- Descrição -->
  <?php foreach ($sobre as $key => $sobValue) { ?>
  <meta property="og:image" content="<?php echo $sobValue['emp_url_imagem'] ?>"/>
  <?php } ?>
  <meta property="og:image:type" content="image/jpeg"/>
  <!-- <meta property="og:image:width" content="270"/>
  <meta property="og:image:height" content="270"/> -->

  <!-- Favicons -->
  <link href="<?php echo $values['conf_favicon_url'] ?>" rel="icon">
  <link href="<?php echo $baseUrl ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo $baseUrl ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $baseUrl ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo $baseUrl ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $baseUrl ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo $baseUrl ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo $baseUrl ?>adm/dist/notiflix/notiflix-2.4.0.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $baseUrl ?>assets/vendor/aos/aos.css" rel="stylesheet" type="text/css" />

  <!-- Template Main CSS File -->
  <link href="<?php echo $baseUrl ?>assets/css/style.php" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <a href="<?php echo $baseUrl ?>"><img src="<?php echo $values['conf_logo_url'] ?>" alt="<?php echo $values['conf_nome'] ?>" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?php echo $baseUrl ?>">Home</a></li>     
          <li><a href="<?php echo $baseUrl ?>#about">Sobre</a></li>
          <?php 
            $sql = $pdo->query("SELECT * FROM modulos WHERE mod_status = 1 and mod_menu = 1 ORDER BY mod_ordem ASC");
            $listMenu = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($listMenu as $Keys => $Vmenu){
          ?>
            <li><a href="<?php echo $baseUrl ?>#<?php echo $Vmenu['mod_slug']?>"><?php echo $Vmenu['mod_titulo'] ?></a></li>
          <?php } ?>
          <li><a href="<?php echo $baseUrl ?>#contact">Contato</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <div class="header-social-links">
        <?php 
            $sql = $pdo->prepare("SELECT * FROM redes_sociais");
            $sql->execute();
            $listaRedes = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($listaRedes as $listR) {
        ?>
          <a href="<?php echo $listR['social_url'] ?>" title="<?php echo $listR['social_titulo'] ?>" target="_blank"><i class="<?php echo $listR['social_icone'] ?>"></i></a>
        <?php } ?>
      </div>

    </div>
  </header><!-- End Header -->