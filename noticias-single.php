<?php 

include 'header.php'; 
include 'select.php';

$slug = $_GET['post'];

$not = $pdo->prepare("SELECT * FROM noticias WHERE not_slug = ?");
$not->execute([$slug]);
$noticia = $not->fetchAll(PDO::FETCH_ASSOC);


?>

  <main id="main">
  <?php foreach($noticia as $keys => $valueNot){ ?>
    <!-- ======= Blog Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Notícia</h2>

          <ol>
            <li><a href="./">Home</a></li>
            <li><a href="noticias">Notícia</a></li>
            <li><?php echo $valueNot['not_titulo'] ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Blog Section -->

    <!-- ======= Blog Section ======= -->
    <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="container">

        <div class="row">
        
          <div class="col-lg-8 entries">

            <article class="entry entry-single">
              <div class="entry-img">
                <img src="<?php echo $valueNot['not_imagem'] ?>" alt="<?php echo $valueNot['not_titulo'] ?>" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="noticias-single?post=<?php echo $valueNot['not_slug'] ?>"><?php echo $valueNot['not_titulo'] ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <!-- <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">John Doe</a></li> -->
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <time datetime="<?php echo $dataPost = date("d/m/Y", strtotime($valueNot['not_data'])) ?>"><?php echo $dataPost = date("d/m/Y", strtotime($valueNot['not_data'])) ?></time></li>
                  <!-- <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">12 Comments</a></li> -->
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?php echo $valueNot['not_texto'] ?>
                </p>

              </div>

              <div class="entry-footer clearfix">
                <div class="float-left">
                  <i class="icofont-folder"></i>
                  <ul class="cats">
                    <li>
                    <?php 
                      $idCat = $valueNot['not_categoria'];
                      $categoria = $pdo->prepare("SELECT * FROM categorias WHERE cat_id = ?");
                      $categoria->execute([$idCat]);
                      foreach($categoria as $key => $nomeCategoria){
                        echo $nomeCategoria['cat_nome'];
                      }
                    ?>
                    </li>
                  </ul>

                  <!-- <i class="icofont-tags"></i>
                  <ul class="tags">
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Tips</a></li>
                    <li><a href="#">Marketing</a></li>
                  </ul> -->
                </div>

                <div class="float-right share">
                  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $baseUrl ?>noticias-single?post=<?php echo $slug ?>" title="Compartilhar no Facebook" target="_blank"><i class="icofont-facebook"></i></a>
                  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $baseUrl ?>noticias-single?post=<?php echo $slug ?>" title="Compartilhar no Linkedin" target="_blank"><i class="icofont-linkedin"></i></a>
                  <a href="https://twitter.com/home?status=<?php echo $baseUrl ?>noticias-single?post=<?php echo $slug ?>" title="Compartilhar no Twitter" target="_blank"><i class="icofont-twitter"></i></a>
                </div>

              </div>

            </article><!-- End blog entry -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <!-- <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="icofont-search"></i></button>
                </form>
              </div> -->
              <!-- End sidebar search formn-->

              <!-- <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  <li><a href="#">General <span>(25)</span></a></li>
                  <li><a href="#">Lifestyle <span>(12)</span></a></li>
                  <li><a href="#">Travel <span>(5)</span></a></li>
                  <li><a href="#">Design <span>(22)</span></a></li>
                  <li><a href="#">Creative <span>(8)</span></a></li>
                  <li><a href="#">Educaion <span>(14)</span></a></li>
                </ul>

              </div> -->
              <!-- End sidebar categories-->

              <h3 class="sidebar-title">Notícias Recentes</h3>
              <div class="sidebar-item recent-posts">
              <?php foreach($noticias as $keys => $valueNot){ ?>
                <div class="post-item clearfix">
                  <img src="<?php echo $valueNot['not_imagem'] ?>" alt="<?php echo $valueNot['not_titulo'] ?>">
                  <h4><a href="noticias-single?post=<?php echo $valueNot['not_slug'] ?>"><?php echo $valueNot['not_titulo'] ?></a></h4>
                  <time datetime="<?php echo $dataPost = date("d/m/Y", strtotime($valueNot['not_data'])) ?>"><?php echo $dataPost = date("d/m/Y", strtotime($valueNot['not_data'])) ?></time>
                </div>
              <?php } ?>
              </div><!-- End sidebar recent posts-->

              <!-- <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>

              </div> -->
              <!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->
        
        </div><!-- End row -->

      </div><!-- End container -->

    </section><!-- End Blog Section -->
    <?php } ?>
  </main><!-- End #main -->

<?php include 'footer.php'; ?>