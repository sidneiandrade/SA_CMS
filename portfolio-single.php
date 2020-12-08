<?php 

include './adm/system/conexao.php';
include 'header.php';

$slug = $_GET['port'];

$dados = $pdo->prepare("SELECT * FROM portfolios WHERE port_slug = ?");
$dados->execute([$slug]);
$listPort = $dados->fetchAll(PDO::FETCH_ASSOC);

if(count($listPort) == 0){
  header('Location: '. $baseUrl .'erro/');
}

foreach($listPort as $keys => $vPort){
  $id = $vPort['port_id'];
  $nome = $vPort['port_nome'];
  $empresa = $vPort['port_empresa'];
  $texto = $vPort['port_texto'];
  $url = $vPort['port_url'];
  $categoria = $vPort['port_categoria'];
}


?>

<main id="main">

<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2><?php echo $nome ?></h2>
      <ol>
        <li><a href="<?php echo $baseUrl ?>">Home</a></li>
        <li><a href="<?php echo $baseUrl ?>portfolios">Portfolio</a></li>
        <li><?php echo $nome ?></li>
      </ol>
    </div>

  </div>
</section><!-- Breadcrumbs Section -->

<!-- ======= Portfolio Details Section ======= -->
<section class="portfolio-details">
  <div class="container">

    <div class="portfolio-details-container">

      <div class="owl-carousel portfolio-details-carousel">

        <?php
        
        $imagem = $pdo->prepare("SELECT * FROM portfolio_imagem WHERE img_port_id = ?");
        $imagem->execute([$id]);
        $urlImagem = $imagem->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($urlImagem as $keys => $ImagemPort ){ ?>
          <img src="<?php echo $ImagemPort['img_imagem'] ?>" class="img-fluid" alt="<?php echo $nome ?>">
        <?php } ?>
      
      </div>

      <div class="portfolio-info">
        <h3>Informações do Projeto</h3>
        <ul>
          <?php 
          
          $Pcategoria = $pdo->prepare("SELECT * FROM categorias WHERE cat_id = ?");
          $Pcategoria->execute([$categoria]);
          $nomeCategoria = $Pcategoria->fetchAll(PDO::FETCH_ASSOC);
          foreach($nomeCategoria as $keys => $categoriaNome){
            echo '<li><strong>Categoria</strong>: '. $categoriaNome['cat_nome'] . '</li>';
          }
          ?>
          <li><strong>Cliente</strong>: <?php echo $empresa ?></li>
          <li><strong>Link</strong>: <a href="<?php echo $url ?>"><?php echo $url ?></a></li>
        </ul>
      </div>

    </div>

    <div class="portfolio-description">
      <h2><?php echo $nome ?></h2>
      <p>
      <?php echo $texto ?>
      </p>
    </div>
  </div>
</section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<?php include 'footer.php'; ?>