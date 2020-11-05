  <?php include 'header.php'; ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">
          <?php 
            $slide = $pdo->prepare("SELECT * FROM SLIDES WHERE SD_STATUS = ? ORDER BY SD_ID DESC");
            $slide->execute([1]);
            $listSlide = $slide->fetchAll(PDO::FETCH_ASSOC);
            $i = 0; 
            foreach($listSlide as $slideValues){
          ?>
          <!-- Slides -->
          <div id="slide_<?php echo $i ?>" class="carousel-item" style="background-image: url('<?php echo $slideValues['sd_url_imagem'] ?>');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown"><?php echo $slideValues['sd_titulo'] ?></h2>
                <p class="animate__animated animate__fadeInUp"><?php echo $slideValues['sd_texto'] ?></p>
                <?php if($slideValues['sd_url_botao'] != '') 
                  echo '<a href="'. $slideValues["sd_url_botao"].'" class="btn-get-started animate__animated animate__fadeInUp scrollto">Saiba mais</a>';
                ?>
              </div>
            </div>
          </div>
          <!-- Slides -->
          <?php $i++; }  ?>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= What We Do Section ======= -->
    <section id="what-we-do" class="what-we-do">
      <div class="container">

        <div class="section-title">
          <h2>What We Do</h2>
          <p>Magnam dolores commodi suscipit consequatur ex aliquid</p>
        </div>

        <div class="row">
          <?php 
            $destaque = $pdo->query("SELECT * FROM DESTAQUE")->fetchAll(PDO::FETCH_ASSOC);
            foreach($destaque as $desValue){
          ?>
            <div class="col-lg-4 col-md-4 d-flex align-items-stretch mb-3">
              <div class="icon-box">
                <div class="icon"><i class="<?php echo $desValue['des_icone'] ?>"></i></div>
                <h4><a href=""><?php echo $desValue['des_titulo'] ?></a></h4>
                <p><?php echo $desValue['des_texto'] ?></p>
              </div>
            </div>
          <?php } ?>
        </div>

      </div>
    </section><!-- End What We Do Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <?php 
          $sobre = $pdo->query("SELECT * FROM EMPRESA")->fetchAll(PDO::FETCH_ASSOC);
          foreach($sobre as $sobValue){ }
        ?>
        <div class="row">
          <div class="col-lg-6">
            <img src="<?php echo $sobValue['emp_imagem'] ?>" class="img-fluid" alt="<?php echo $values['conf_nome']?>">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <h3>Sobre</h3>
              <p><?php echo $sobValue['emp_descricao'] ?></p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
      <div class="container">

        <div class="row skills-content">

          <div class="col-lg-6">

            <div class="progress">
              <span class="skill">HTML <i class="val">100%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">CSS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">JavaScript <i class="val">75%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">

            <div class="progress">
              <span class="skill">PHP <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">WordPress/CMS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">Photoshop <i class="val">55%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Counts Section ======= -->
    <?php if($listModulos[9]['mod_status'] == 1){?>
      <section id="counts" class="counts">
        <div class="container">

          <div class="row">
            <?php 
              $numeros = $pdo->query("SELECT * FROM NUMEROS")->fetchAll(PDO::FETCH_ASSOC);
              foreach($numeros as $numValue){
            ?>
              <div class="col-lg-3 col-6 mb-3">
                <div class="count-box">
                  <i class="<?php echo $numValue['num_icone'] ?>"></i>
                  <span data-toggle="counter-up"><?php echo $numValue['num_numero'] ?></span>
                  <p><?php echo $numValue['num_titulo'] ?></p>
                </div>
              </div>
            <?php } ?>
          </div>

        </div>
      </section>
    <?php } else {} ?><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <?php if($listModulos[2]['mod_status'] == 1){?>
      <section id="services" class="services section-bg">
        <div class="container">
          <div class="section-title">
            <h2><?php echo $listModulos[2]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[2]['mod_descricao'] ?></p>
          </div>

          <div class="row">
            <?php 
              $servicos = $pdo->query("SELECT * FROM SERVICOS")->fetchAll(PDO::FETCH_ASSOC);
              foreach($servicos as $serValue){
            ?>
            
            <div class="col-md-6 mb-3">
              <div class="icon-box">
                <i class="<?php echo $serValue['serv_icone'] ?>"></i>
                <h4><a href="#"><?php echo $serValue['serv_titulo'] ?></a></h4>
                <p><?php echo $serValue['serv_texto'] ?></p>
              </div>
            </div>

            <?php } ?>

        </div>
      </section>
    <?php } else {} ?><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <?php if($listModulos[3]['mod_status'] == 1){?>
      <section id="portfolio" class="portfolio">
        <div class="container">

          <div class="section-title">
          <h2><?php echo $listModulos[3]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[3]['mod_descricao'] ?></p>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li>
                <?php 
                  $catPort = $pdo->prepare("SELECT * FROM CATEGORIAS WHERE CAT_ORIGEM = 'P' AND CAT_STATUS = 1");
                  $catPort->execute();
                  $listCat = $catPort->fetchAll(PDO::FETCH_ASSOC);
                  foreach($listCat as $catPortValues){
                ?>
                    <li data-filter=".filter-<?php echo $catPortValues['cat_slug']?>"><?php echo $catPortValues['cat_nome']?></li>
                <?php } ?>
              </ul>
            </div>
          </div>

          <div class="row portfolio-container">
            <?php 
              $port = $pdo->prepare("SELECT PORT_NOME, PORT_SLUG, CAT_NOME, CAT_SLUG FROM PORTFOLIOS JOIN CATEGORIAS ON (PORT_CATEGORIA = CAT_ID) WHERE PORT_STATUS = ?");
              $port->execute([1]);
              $listPort = $port->fetchAll(PDO::FETCH_ASSOC);
              foreach($listPort as $portValues){
            ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $portValues['CAT_SLUG'] ?> wow fadeInUp">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-1.jpg" data-gall="portfolioGallery" class="link-preview venobox" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html"><?php echo $portValues['PORT_NOME'] ?></a></h4>
                  <p><?php echo $portValues['CAT_NOME']?></p>
                </div>
              </div>
            </div>
            <?php } ?>

            <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-2.jpg" class="link-preview venobox" data-gall="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Web 3</a></h4>
                  <p>Web</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-3.jpg" class="link-preview venobox" data-gall="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">App 2</a></h4>
                  <p>App</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-4.jpg" class="link-preview venobox" data-gall="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Card 2</a></h4>
                  <p>Card</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-5.jpg" class="link-preview venobox" data-gall="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Web 2</a></h4>
                  <p>Web</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-6.jpg" class="link-preview venobox" data-gall="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">App 3</a></h4>
                  <p>App</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-7.jpg" class="link-preview venobox" data-gall="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Card 1</a></h4>
                  <p>Card</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp" data-wow-delay="0.1s">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-8.jpg" class="link-preview venobox" data-gall="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Card 3</a></h4>
                  <p>Card</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.2s">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-9.jpg" class="link-preview venobox" data-gall="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Web 1</a></h4>
                  <p>Web</p>
                </div>
              </div>
            </div> -->

          </div>

        </div>
      </section>
    <?php } else {} ?><!-- End Portfolio Section -->

    <!-- ======= News Section ======= -->
    <?php if($listModulos[0]['mod_status'] == 1){?>
      <section id="news" class="news section-bg">
        <div class="container">
              <div class="section-title">
                <h2><?php echo $listModulos[0]['mod_titulo'] ?></h2>
                <p><?php echo $listModulos[0]['mod_descricao'] ?></p>
              </div>

              <div class="row">

              </div>
          </div>
      </section>
    <?php } else {} ?><!-- End News Section -->

    <!-- ======= Clients Section ======= -->
    <?php if($listModulos[5]['mod_status'] == 1){?>
      <section id="clients" class="clients">
        <div class="container">
          <div class="section-title">
            <h2><?php echo $listModulos[5]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[5]['mod_descricao'] ?></p>
          </div>
          <div class="row no-gutters clients-wrap clearfix wow fadeInUp">
            <?php 
              $clientes = $pdo->prepare("SELECT * FROM CLIENTES WHERE CLI_STATUS = ?");
              $clientes->execute([1]);
              $listClientes = $clientes->fetchAll(PDO::FETCH_ASSOC);
              foreach($listClientes as $keys => $cliValues){
            ?>

            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo" data-aos="zoom-in">
                <img src="<?php echo $cliValues['cli_url_imagem'] ?>" class="img-fluid" alt="<?php echo $cliValues['cli_empresa'] ?>">
              </div>
            </div>

            <?php } ?>
            <!-- <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo" data-aos="zoom-in" data-aos-delay="100">
                <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo" data-aos="zoom-in" data-aos-delay="150">
                <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo" data-aos="zoom-in" data-aos-delay="200">
                <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo" data-aos="zoom-in" data-aos-delay="250">
                <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo" data-aos="zoom-in" data-aos-delay="300">
                <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6">
              <div class="client-logo" data-aos="zoom-in" data-aos-delay="350">
                <img src="assets/img/clients/client-7.png" class="img-fluid" alt="">
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6" data-aos="zoom-in" data-aos-delay="400">
              <div class="client-logo">
                <img src="assets/img/clients/client-8.png" class="img-fluid" alt="">
              </div>
            </div> -->
          </div>
        </div>
      </section>
    <?php } else {} ?><!-- End Clients Section -->

    <!-- ======= Testimonials Section ======= -->
    <?php if($listModulos[8]['mod_status'] == 1){?>
      <section id="testimonials" class="testimonials section-bg">
        <div class="container">

          <div class="section-title">
          <h2><?php echo $listModulos[8]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[8]['mod_descricao'] ?></p>
          </div>

          <div class="owl-carousel testimonials-carousel">
            <?php 
              $depoimentos = $pdo->query("SELECT * FROM DEPOIMENTOS")->fetchAll(PDO::FETCH_ASSOC);
              foreach($depoimentos as $depValue){
            ?>

            <div class="testimonial-item">
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                <?php echo $depValue['dep_texto'] ?>
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
              <!-- <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt=""> -->
              <h3><?php echo $depValue['dep_nome'] ?></h3>
              <h4><?php echo $depValue['dep_empresa'] ?></h4>
            </div>

            <?php } ?>

          </div>

        </div>
      </section>
    <?php } else {} ?><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <?php if($listModulos[4]['mod_status'] == 1){?>
      <section id="team" class="team">
        <div class="container">

          <div class="section-title">
            <h2><?php echo $listModulos[4]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[4]['mod_descricao'] ?></p>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <img src="assets/img/team/team-1.jpg" alt="">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>
                  Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
                </p>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <img src="assets/img/team/team-2.jpg" alt="">
                <h4>Sarah Jhinson</h4>
                <span>Product Manager</span>
                <p>
                  Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
                </p>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <img src="assets/img/team/team-3.jpg" alt="">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>
                  Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                </p>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>

          </div>

        </div>
      </section>
    <?php } else {} ?><!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->
    <?php if($listModulos[6]['mod_status'] == 1){?>
      <section id="pricing" class="pricing section-bg">
        <div class="container">

          <div class="section-title">
            <h2><?php echo $listModulos[6]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[6]['mod_descricao'] ?></p>
          </div>

          <div class="row">
            <?php 
            
              $valores = $pdo->query("SELECT * FROM VALORES")->fetchAll(PDO::FETCH_ASSOC);
              foreach($valores as $key => $valValue){
            
            ?>
            <div class="col-lg-3 col-md-6">
              <div class="box ">
                <?=($valValue['val_destaque'] > 0) ? '<span class="advanced">Mais Vendido</span>' : '' ?>
                <h3><?php echo $valValue['val_titulo'] ?></h3>
                <h4><sup>R$</sup><?php echo $valValue['val_valor'] ?>
                  <span> / 
                  <?php 
                    switch($valValue['val_frequencia']){
                      case '0':
                        echo "mensal";
                      break;

                      case '1':
                        echo "trimestral";
                      break;

                      case '2':
                        echo "anual";
                      break;
                    }
                  ?>
                  </span></h4>
                <?php echo $valValue['val_texto'] ?>
                <div class="btn-wrap">
                  <a href="<?php echo $valValue['val_url'] ?>" class="btn-buy"><?php echo $valValue['val_btn_titulo'] ?></a>
                </div>
              </div>
            </div>

              <?php } ?>

            <!-- <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
              <div class="box featured">
                <h3>Business</h3>
                <h4><sup>$</sup>19<span> / month</span></h4>
                <ul>
                  <li>Aida dere</li>
                  <li>Nec feugiat nisl</li>
                  <li>Nulla at volutpat dola</li>
                  <li>Pharetra massa</li>
                  <li class="na">Massa ultricies mi</li>
                </ul>
                <div class="btn-wrap">
                  <a href="#" class="btn-buy">Buy Now</a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
              <div class="box">
                <h3>Developer</h3>
                <h4><sup>$</sup>29<span> / month</span></h4>
                <ul>
                  <li>Aida dere</li>
                  <li>Nec feugiat nisl</li>
                  <li>Nulla at volutpat dola</li>
                  <li>Pharetra massa</li>
                  <li>Massa ultricies mi</li>
                </ul>
                <div class="btn-wrap">
                  <a href="#" class="btn-buy">Buy Now</a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
              <div class="box">
                <span class="advanced">Advanced</span>
                <h3>Ultimate</h3>
                <h4><sup>$</sup>49<span> / month</span></h4>
                <ul>
                  <li>Aida dere</li>
                  <li>Nec feugiat nisl</li>
                  <li>Nulla at volutpat dola</li>
                  <li>Pharetra massa</li>
                  <li>Massa ultricies mi</li>
                </ul>
                <div class="btn-wrap">
                  <a href="#" class="btn-buy">Buy Now</a>
                </div>
              </div>
            </div> -->

          </div>

        </div>
      </section>
    <?php } else {} ?><!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <?php if($listModulos[7]['mod_status'] == 1){?>
      <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2><?php echo $listModulos[7]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[7]['mod_descricao'] ?></p>
          </div>

          <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">
            <?php 
              $perguntas = $pdo->prepare("SELECT * FROM PERGUNTAS WHERE PG_STATUS = 1 ORDER BY PG_ID ASC");
              $perguntas->execute();
              $listPerguntas = $perguntas->fetchAll(PDO::FETCH_ASSOC);
              foreach($listPerguntas as $pergValues){
            ?>
            <li>
              <a data-toggle="collapse" class="collapsed" href="#faq_<?php echo $pergValues['pg_id'] ?>"><?php echo $pergValues['pg_pergunta'] ?> <i class="icofont-simple-up"></i></a>
              <div id="faq_<?php echo $pergValues['pg_id'] ?>" class="collapse" data-parent=".faq-list">
                <p>
                  <?php echo $pergValues['pg_resposta'] ?>
                </p>
              </div>
            </li>
            <?php } ?>

          </ul>

        </div>
      </section>
    <?php } else {} ?><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Contato</h2>
          <p>Para maiores informações entre em contato conosco.</p>
        </div>

        <div class="row mt-5 justify-content-center">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="icofont-google-map"></i>
                  <h4>Endereço:</h4>
                  <p><?php echo $values['conf_endereco'] ?></p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-envelope"></i>
                  <h4>E-mail:</h4>
                  <p><?php echo $values['conf_email'] ?></p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-phone"></i>
                  <h4>Contatos:</h4>
                  <p><?php echo $values['conf_telefone'] ?></p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center">
          <div class="col-lg-10">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nome" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Mensagem"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Carregando...</div>
                <div class="error-message"></div>
                <div class="sent-message">Sua mensagem foi enviada com sucesso. Entraremos em contato!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensagem</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <?php include 'footer.php'; ?>

  <script>
      //adicionar a class active no primeiro slide
      $('#slide_0').addClass("active");
  </script>