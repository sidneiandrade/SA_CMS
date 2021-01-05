<?php 

include 'header.php'; 
//include 'select.php';

$slug = $_GET['pag'];

$not = $pdo->prepare("SELECT * FROM paginas WHERE pag_slug = ?");
$not->execute([$slug]);
$pagina = $not->fetchAll(PDO::FETCH_ASSOC);

if(count($pagina) == 0){
  header('Location: '. $baseUrl .'erro/');
}


?>

  <main id="main">
  <?php foreach($pagina as $value){ ?>

    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?php echo $value['pag_titulo'] ?></h2>
        </div>

      </div>
    </section>

    <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="container">

        <div class="row">
        
          <div class="col-lg-12 entries">

            <article class="entry entry-single">
              <div class="entry-img">
                <img src="<?php echo $value['pag_imagem'] ?>" alt="<?php echo $value['pag_titulo'] ?>" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <?php echo $value['pag_titulo'] ?>
              </h2>

              <div class="entry-content">
                <p>
                  <?php echo $value['pag_texto'] ?>
                </p>
              </div>

            </article>

          </div>
        
        </div>

      </div>

    </section>
    <?php } ?>
  </main>

<?php include 'footer.php'; ?>