<?php 

include "header.php"; 

$noticias = $pdo->prepare("SELECT * FROM noticias WHERE not_status = 1");
$noticias->execute();
$list = $noticias->fetchAll(PDO::FETCH_ASSOC);


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


            <?php 
              foreach($list as $valueNot){
            ?> 


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

      </div><!-- End .container -->

    </section><!-- End Blog Section -->

  </main><!-- End #main -->

 <?php include "footer.php" ?>