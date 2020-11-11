<?php 

include './adm/system/conexao.php';

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
  <meta content="<?php echo $values['conf_descricao'] ?>" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo $values['conf_favicon_url'] ?>" rel="icon">
  <link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet" type="text/css" />
  <link href="./assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="./assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="./assets/css/style.php" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <!-- <h1><a href="index">Lumia</a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="./"><img src="<?php echo $values['conf_logo_url'] ?>" alt="<?php echo $values['conf_nome'] ?>" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="./">Home</a></li>
          <!-- <li class="drop-down"><a href="">Sobre</a>
            <ul>
              <li><a href="#about">Sobre</a></li>
              <li><a href="#team">Equipe</a></li>
              <li class="drop-down"><a href="#">Deep Drop Dow</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
            </ul>
          </li> -->
          <!-- <li><a href="./#dest">Campanha</a></li> -->
          <li><a href="./#about">Sobre</a></li>
          <li><a href="./#services">Serviços</a></li>
          <li><a href="./#portfolio">Portfólio</a></li>
          <li><a href="./#news">Notícias</a></li>
          <li><a href="./#testimonials">Depoimentos</a></li>
          <li><a href="./#contact">Contato</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <div class="header-social-links">
        <?= ($values['conf_facebook'] != '') ? '<a href="'.$values['conf_facebook'].'" class="facebook"><i class="icofont-facebook"></i></a>' : '' ?> 
        <?= ($values['conf_instagram'] != '') ? '<a href="'.$values['conf_instagram'].'" class="instagram"><i class="icofont-instagram"></i></a>' : '' ?> 
        <?= ($values['conf_youtube'] != '') ? '<a href="'.$values['conf_youtube'].'" class="youtube"><i class="icofont-youtube-play"></i></a>' : '' ?> 
        <?= ($values['conf_linkedin'] != '') ? '<a href="'.$values['conf_linkedin'].'" class="linkedin"><i class="icofont-linkedin"></i></a>' : '' ?> 

        <!-- <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a> -->
      </div>

    </div>
  </header><!-- End Header -->