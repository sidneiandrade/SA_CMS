<?php 

include "header.php"; 

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1; 

$dados = $pdo->prepare("SELECT * FROM portfolios WHERE port_status = ? ORDER BY port_id DESC");
$dados->execute([1]);
$dadosPort = $dados->fetchAll(PDO::FETCH_ASSOC);

$catPort = $pdo->prepare("SELECT * FROM categorias WHERE cat_origem = ? AND cat_status = ?");
$catPort->execute(['P',1]);
$listCat = $catPort->fetchAll(PDO::FETCH_ASSOC);

$total = count($dadosPort); //total de postagens
$registros = 6; //postagens na página
$numPaginas = ceil($total/$registros); //números de páginas
$inicio = ($registros*$pagina)-$registros; //

$portfolioPG = $pdo->prepare("SELECT * FROM portfolios WHERE port_status = 1 ORDER BY port_id DESC LIMIT $inicio, $registros ");
$portfolioPG->execute();
$list = $portfolioPG->fetchAll(PDO::FETCH_ASSOC);

?>

  <main id="main">

    <!-- ======= Blog Section ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfólio</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Portfólio</li>
          </ol>
        </div>
      </div>
    </section><!-- End Blog Section -->

    <!-- ======= Blog Section ======= -->
    <section class="portfolio" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="container">

        <div class="row">
            <div class="col-lg-12">
              <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">Todos</li>
                <?php foreach ($listCat as $key => $catPortValues) { ?>
                  <li data-filter=".filter-<?php echo $catPortValues['cat_slug'] ?>"><?php echo $catPortValues['cat_nome'] ?></li>
                <?php } ?>
              </ul>
            </div>
        </div>

        <div class="row portfolio-container">
            <?php
            foreach ($dadosPort as $keys => $valuePort) {
              $idPort = $valuePort['port_id'];
              $nomePort = $valuePort['port_nome'];
              $slugPort = $valuePort['port_slug'];
              $categoria = $valuePort['port_categoria'];
              $dadosCat = $pdo->query("SELECT cat_nome, cat_slug FROM categorias WHERE cat_id = $categoria AND cat_origem = 'p'")->fetch(PDO::FETCH_ASSOC);
              $imagem = $pdo->query("SELECT img_imagem FROM portfolio_imagem WHERE img_port_id = $idPort LIMIT 1")->fetch(PDO::FETCH_ASSOC);
            ?>
              <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $dadosCat['cat_slug'] ?> wow fadeInUp">
                <div class="portfolio-wrap">
                  <figure>
                    <img src="<?php echo $imagem['img_imagem'] ?>" class="img-fluid" alt="<?php echo $nomePort ?>">
                    <a href="<?php echo $imagem['img_imagem'] ?>" data-gall="portfolioGallery" class="link-preview venobox" title="Visualizar"><i class="bx bx-plus"></i></a>
                    <a href="portfolio-single?port=<?php echo $slugPort ?>" class="link-details" title="Detalhes"><i class="bx bx-link"></i></a>
                  </figure>

                  <div class="portfolio-info">
                    <h4><a href="portfolio-single?port=<?php echo $slugPort ?>"><?php echo $nomePort ?></a></h4>
                    <p><?php echo $dadosCat['cat_nome'] ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>
        </div>

        <div class="blog">
            <div class="blog-pagination" data-aos="fade-up">
                <ul class="justify-content-center">
                    <?php
                    if($pagina > 1) {
                        echo "<li><a href='noticias?pagina=".($pagina - 1)."'><i class='icofont-rounded-left'></i></a></li>";
                    }

                    for($i = 1; $i < $numPaginas + 1; $i++) { 
                        $ativo = ($i == $pagina) ? 'class="active"' : '';
                        echo "<li ".$ativo."><a href='noticias?pagina=$i'>".$i."</a></li>"; 
                    } 

                    if($pagina < $numPaginas) {
                        echo "<li><a href='noticias?pagina=".($pagina + 1)."'><i class='icofont-rounded-right'></i></a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

      </div><!-- End .container -->
    </section><!-- End Blog Section -->
  </main><!-- End #main -->

 <?php include "footer.php" ?>