<?php 

include "header.php"; 

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1; 

$noticias = $pdo->prepare("SELECT * FROM noticias WHERE not_status = 1");
$noticias->execute();
$totalNoticias = $noticias->fetchAll(PDO::FETCH_ASSOC);

$total = count($totalNoticias); //total de postagens
$registros = 6; //postagens na página
$numPaginas = ceil($total/$registros); //números de páginas
$inicio = ($registros*$pagina)-$registros; //

$noticiasPG = $pdo->prepare("SELECT * FROM noticias WHERE not_status = 1 ORDER BY not_id DESC LIMIT $inicio, $registros ");
$noticiasPG->execute();
$list = $noticiasPG->fetchAll(PDO::FETCH_ASSOC);

?>

  <main id="main">

    <!-- ======= Blog Section ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Notícias</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Notícias</li>
          </ol>
        </div>
      </div>
    </section><!-- End Blog Section -->

    <!-- ======= Blog Section ======= -->
    <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="container">
        <div class="row">
            <?php foreach($list as $valueNot){ ?> 
              <div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <article class="entry">

                  <div class="entry-img">
                    <img src="<?php echo $valueNot['not_imagem'] ?>" alt="<?php echo $valueNot['not_titulo'] ?>" class="img-fluid">
                  </div>

                  <h2 class="entry-title">
                    <a href="noticias-single?post=<?php echo $valueNot['not_slug'] ?>"><?php echo $valueNot['not_titulo'] ?></a>
                  </h2>

                  <div class="entry-meta">
                    <ul>
                      <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i><time datetime="<?php echo $dataPost = date("d/m/Y", strtotime($valueNot['not_data'])) ?>"><?php echo $dataPost = date("d/m/Y", strtotime($valueNot['not_data'])) ?></time></li>
                    </ul>
                  </div>

                  <div class="entry-content">
                    <p>
                      <?php echo $textoResumido = substr(strip_tags($valueNot['not_texto']),0,90).'...'; ?>
                    </p>
                    <div class="read-more">
                      <a href="noticias-single?post=<?php echo $valueNot['not_slug'] ?>">Saiba Mais</a>
                    </div>
                  </div>

                </article><!-- End blog entry -->
              </div>
            <?php } ?>
        </div><!-- End .row -->
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

      </div><!-- End .container -->
    </section><!-- End Blog Section -->
  </main><!-- End #main -->

 <?php include "footer.php" ?>