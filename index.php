  <?php

  include 'header.php';
  include 'select.php';

  ?>

  <!-- ======= Hero Section ======= -->
  <?php if ($listModulos[10]['mod_status'] == 1) { ?>
    <section id="hero">
      <div class="hero-container">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-aos="fade-right" data-aos-duration="1000">

          <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

          <div class="carousel-inner" role="listbox">
            <?php
            foreach ($listSlide as $key => $slideValues) {
            ?>
              <!-- Slides -->
              <div id="slide_<?php echo $i ?>" class="carousel-item" style="background-image: url('<?php echo $slideValues['sd_url_imagem'] ?>');">
                <div class="carousel-container" data-aos="fade-up" data-aos-duration="1000">
                  <div class="carousel-content container">
                    <h2><?php echo $slideValues['sd_titulo'] ?></h2>
                    <p><?php echo $slideValues['sd_texto'] ?></p>
                    <?php if ($slideValues['sd_url_botao'] != '')
                      echo '<a href="' . $slideValues["sd_url_botao"] . '" class="btn-get-started scrollto">Saiba mais</a>';
                    ?>
                  </div>
                </div>
              </div>
              <!-- Slides -->
            <?php $i++;
            }  ?>
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
  <?php } else {} ?>

  <main id="main">

    <!-- ======= What We Do Section ======= -->
    <section id="dest" class="what-we-do">
      <div class="container">

        <div class="section-title" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
          <h2>Nossos Destaques</h2>
          <p>Veja o que nossa empresa pode oferecer para você.</p>
        </div>

        <div class="row" data-aos="fade-right" data-aos-offset="600" data-aos-easing="ease-in-sine">
          <?php foreach ($destaque as $key => $desValue) { ?>
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
    <section id="about" class="about pb-5">
      <div class="container" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
        <div class="section-title">
          <h2>Sobre</h2>
        </div>
        <?php foreach ($sobre as $key => $sobValue) {
        } ?>
        <div class="row" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
          <div class="col-lg-6 d-flex align-items-center">
            <img src="<?php echo $sobValue['emp_url_imagem'] ?>" class="img-fluid rounded" alt="<?php echo $values['conf_nome'] ?>">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p><?php echo $sobValue['emp_descricao'] ?></p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
      <div class="container" data-aos="fade-up"  data-aos-offset="300" data-aos-anchor-placement="top-bottom">
        <div class="row skills-content">
          <?php foreach ($Skill as $key => $skValue) { ?> 
          <div class="col-lg-6">
            <div class="progress">
              <span class="skill"><?php echo $skValue['sk_titulo'] ?> <i class="val"><?php echo $skValue['sk_valor']?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $skValue['sk_valor']?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- End Skills Section -->

    <!-- ======= Counts Section ======= -->
    <?php if ($listModulos[9]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[9]['mod_slug'] ?>" class="counts">
        <div class="container" data-aos="zoom-in"  data-aos-offset="300" data-aos-anchor-placement="top-bottom">

          <div class="row">
            <?php foreach ($numeros as $key => $numValue) { ?>
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
    <?php } else {} ?>
    <!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <?php if ($listModulos[2]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[2]['mod_slug'] ?>" class="services section-bg">
        <div class="container" data-aos="fade-up" data-aos-easing="linear">
          <div class="section-title">
            <h2><?php echo $listModulos[2]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[2]['mod_descricao'] ?></p>
          </div>

          <div class="row" data-aos="fade-up" data-aos-duration="300" data-aos-easing="linear">
            <?php foreach ($servicos as $key => $serValue) { ?>

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
    <?php } else {} ?>
    <!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <?php if ($listModulos[3]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[3]['mod_slug'] ?>" class="portfolio">
        <div class="container">

          <div class="section-title" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <h2><?php echo $listModulos[3]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[3]['mod_descricao'] ?></p>
          </div>

          <div class="row" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="col-lg-12">
              <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">Todos</li>
                <?php foreach ($listCat as $key => $catPortValues) { ?>
                  <li data-filter=".filter-<?php echo $catPortValues['cat_slug'] ?>"><?php echo $catPortValues['cat_nome'] ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>

          <div class="row portfolio-container" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
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
                    <a href="portfolio/<?php echo $slugPort ?>" class="link-details" title="Detalhes"><i class="bx bx-link"></i></a>
                  </figure>

                  <div class="portfolio-info">
                    <h4><a href="portfolio/<?php echo $slugPort ?>"><?php echo $nomePort ?></a></h4>
                    <p><?php echo $dadosCat['cat_nome'] ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>

          </div>

          <div class="read-more text-center">
            <a href="portfolios" class="btn-get-started"><i class="far fa-check-circle"></i> Veja mais</a>
          </div>

        </div>
      </section>
    <?php } else {} ?>
    <!-- End Portfolio Section -->

    <!-- ======= News Section ======= -->
    <?php if ($listModulos[0]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[0]['mod_slug'] ?>" class="news section-bg">
        <div class="container">
          <div class="section-title" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <h2><?php echo $listModulos[0]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[0]['mod_descricao'] ?></p>
          </div>

          <section id="blog" class="blog">
            <div class="container">
              <div class="row">

              <?php foreach($noticias as $keys => $valueNot){ ?>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                  <article class="entry">

                    <div class="entry-img">
                      <img src="<?php echo $valueNot['not_imagem'] ?>" alt="<?php echo $valueNot['not_titulo'] ?>" class="img-fluid">
                    </div>

                    <h2 class="entry-title">
                      <a href="noticia/<?php echo $valueNot['not_slug'] ?>"><?php echo $valueNot['not_titulo'] ?></a>
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
                        <a href="noticia/<?php echo $valueNot['not_slug'] ?>">Saiba Mais</a>
                      </div>
                    </div>

                  </article><!-- End blog entry -->
                </div>

              <?php } ?>


              </div>
              <div class="read-more text-center">
                <a href="noticias" class="btn-get-started"><i class="far fa-check-circle"></i> Veja mais notícias</a>
              </div>
            </div>
          </section>
        </div>
      </section>
    <?php } else {} ?>
    <!-- End News Section -->

    <!-- ======= Clients Section ======= -->
    <?php if ($listModulos[5]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[5]['mod_slug'] ?>" class="clients">
        <div class="container">
          <div class="section-title" data-aos="fade-right" data-aos-delay="100" data-aos-easing="ease-in-sine">
            <h2><?php echo $listModulos[5]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[5]['mod_descricao'] ?></p>
          </div>
          <div class="row no-gutters clients-wrap clearfix wow fadeInUp">
            <?php foreach ($listClientes as $key => $cliValues) { ?>

              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="client-logo" data-aos="zoom-in">
                  <img src="<?php echo $cliValues['cli_url_imagem'] ?>" class="img-fluid" alt="<?php echo $cliValues['cli_empresa'] ?>">
                </div>
              </div>

            <?php } ?>

          </div>
        </div>
      </section>
    <?php } else {} ?>
    <!-- End Clients Section -->

    <!-- ======= Cta Section ======= -->
    <?php if ($listModulos[12]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[12]['mod_slug'] ?>" class="cta">
        <div class="container">
        <?php foreach($dadosCta as $keys => $ctaValue){ ?>
          <div class="row" data-aos="zoom-in">
            <div class="col-lg-9 text-center text-lg-left">
              <h3><?php echo $ctaValue['cta_titulo'] ?></h3>
              <p><?php echo $ctaValue['cta_texto'] ?></p>
            </div>
            <div class="col-lg-3 cta-btn-container text-center">
              <a class="cta-btn align-middle" href="<?php echo $ctaValue['cta_url_btn'] ?>" style="padding: 20px;background: <?php echo $ctaValue['cta_cor_btn'] ?>">
                <i class="<?php echo $ctaValue['cta_icone'] ?>"></i> <?php echo $ctaValue['cta_titulo_btn'] ?>
              </a>
            </div>
          </div>
        <?php } ?>
        </div>
      </section>
    <?php } else {} ?>
    <!-- End Cta Section -->

    <!-- ======= Testimonials Section ======= -->
    <?php if ($listModulos[8]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[8]['mod_slug'] ?>" class="testimonials section-bg">
        <div class="container">

          <div class="section-title" data-aos="fade-left" data-aos-delay="100" data-aos-easing="ease-in-sine">
            <h2><?php echo $listModulos[8]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[8]['mod_descricao'] ?></p>
          </div>

          <div class="owl-carousel testimonials-carousel" data-aos="fade-up" data-aos-delay="100">
            <?php foreach ($depoimentos as $key => $depValue) { ?>

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
    <?php } else {} ?>
    <!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <?php if ($listModulos[4]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[4]['mod_slug'] ?>" class="team">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2><?php echo $listModulos[4]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[4]['mod_descricao'] ?></p>
          </div>

          <div class="row" data-aos="fade-up" data-aos-delay="200" data-aos-duration="300">
            <?php foreach ($listMembros as $key => $mbValues) { ?>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="member">
                  <img src="<?php echo $mbValues['mb_url_imagem'] ?>" alt="<?php echo $mbValues['mb_nome'] ?>">
                  <h4><?php echo $mbValues['mb_nome'] ?></h4>
                  <span><?php echo $mbValues['mb_cargo'] ?></span>
                  <!-- <p>
                  Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
                </p> -->
                  <div class="social">
                    <a href="<?php echo $mbValues['mb_facebook'] ?>"><i class="icofont-facebook"></i></a>
                    <a href="<?php echo $mbValues['mb_instagram'] ?>"><i class="icofont-instagram"></i></a>
                    <a href="<?php echo $mbValues['mb_linkedin'] ?>"><i class="icofont-linkedin"></i></a>
                    <a href="<?php echo $mbValues['mb_twitter'] ?>"><i class="icofont-twitter"></i></a>
                  </div>
                </div>
              </div>

            <?php } ?>

          </div>
        </div>
      </section>
    <?php } else {} ?>
    <!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->
    <?php if ($listModulos[6]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[6]['mod_slug'] ?>" class="pricing section-bg">
        <div class="container" data-aos="fade-left" data-aos-offset="300" data-aos-duration="300">

          <div class="section-title">
            <h2><?php echo $listModulos[6]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[6]['mod_descricao'] ?></p>
          </div>

          <div class="row" data-aos="fade-left" data-aos-offset="300" data-aos-duration="1000">
            <?php foreach ($valores as $key => $valValue) { ?>

              <div class="col-lg-3 col-md-6">
                <div class="box ">
                  <?= ($valValue['val_destaque'] > 0) ? '<span class="advanced">Mais Vendido</span>' : '' ?>
                  <h3><?php echo $valValue['val_titulo'] ?></h3>
                  <h4><sup>R$</sup><?php echo $valValue['val_valor'] ?>
                    <span> /
                      <?php echo $valValue['val_frequencia'] ?>
                    </span></h4>
                  <?php echo $valValue['val_texto'] ?>
                  <div class="btn-wrap">
                    <a href="<?php echo $valValue['val_url'] ?>" class="btn-buy"><?php echo $valValue['val_btn_titulo'] ?></a>
                  </div>
                </div>
              </div>

            <?php } ?>
          </div>

        </div>
      </section>
    <?php } else {} ?>
    <!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <?php if ($listModulos[7]['mod_status'] == 1) { ?>
      <section id="<?php echo $listModulos[7]['mod_slug'] ?>" class="faq">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2><?php echo $listModulos[7]['mod_titulo'] ?></h2>
            <p><?php echo $listModulos[7]['mod_descricao'] ?></p>
          </div>

          <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

            <?php foreach ($listPerguntas as $key => $pergValues) { ?>
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
    <?php } else {} ?>
    <!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-left" data-aos-offset="300" data-aos-duration="300">
          <h2>Contato</h2>
          <p>Para maiores informações entre em contato conosco.</p>
        </div>

        <div class="row mt-5 justify-content-center" data-aos="fade-left" data-aos-offset="300" data-aos-duration="300">

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

        <div class="row mt-5 justify-content-center" data-aos="fade-up" data-aos-offset="300" data-aos-delay="300">
          <div class="col-lg-10">
            <form id="formContato" method="post" class="php-email-form" enctype="multipart/form-data">
              <div class="form-row">
                <div class="col-md-4 form-group">
                  <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" data-rule="minlen:4" data-msg="Por favor adicione o nome" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-4 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" data-rule="email" data-msg="Por favor adicione um e-mail válido" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-4 form-group">
                  <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone" data-rule="minlen:12" data-msg="Por favor coloque um telefone" />  
                  <div class="validate"></div>
                </div>
                <div class="col-md-12 form-group">
                  <input type="text" class="form-control" name="assunto" id="assunto" placeholder="Assunto" data-rule="minlen:4" data-msg="Por favor coloque um assunto" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control" id="mensagem" name="mensagem" rows="5" data-rule="required" data-msg="Por favor coloque uma mensagem" placeholder="Mensagem"></textarea>
                <div class="validate"></div>
              </div>
              <div class="text-center">
                <button type="submit">Enviar Mensagem</button>
              </div>
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

    let Form = '#formContato';

    $(Form).submit(function(){
      Notiflix.Loading.Pulse('Carregando...');
      $nome = $("#nome").val();
      $email = $("#email").val();
      $telefone = $("#telefone").val();
      $assunto = $("#assunto").val();
      $mensagem = $("#mensagem").val();
      if($nome != "" && $email != "" && $assunto != "" && $telefone != "" && $mensagem != ""){
        debugger;
        $.ajax({
          type: "POST",
          url: "forms/contact.php",
          data: new FormData($(Form)[0]),
          processData: false,
          contentType: false,
          success: function(data) {
            debugger;
                if (data.result == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Report.Success( 
                      'Enviado!', 
                      data.mensagem, 
                      'OK' ); 
                    //Notiflix.Notify.Success(data.mensagem);
                    setTimeout(function(){
                      location.reload()
                    }, 3000);
                } else {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Failure(data.mensagem);
                }
          }
        });
      } else {
        Notiflix.Loading.Remove();
        Notiflix.Notify.Failure('Favor preencher todos os dados!');
        return false;
      }
      
    })

  </script>