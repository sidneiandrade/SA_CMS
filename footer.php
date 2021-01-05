  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container d-md-flex py-4">
      <div class="col-lg-12 text-center">
        <div class="copyright mb-3 mt-3">
          <img src="<?php echo $values['conf_logo_url'] ?>" alt="<?php echo $values['conf_nome'] ?>" class="img-fluid" style="max-width: 250px"><br>
          <?php echo $values['conf_descricao'] ?>. Todos os direitos reservados.<br>
          <strong>CNPJ:</strong> <?php echo $values['conf_cnpj'] ?>
        </div>
        <div class="social-links mt-3 mb-3">
          <?php 
              $sql = $pdo->prepare("SELECT * FROM redes_sociais");
              $sql->execute();
              $listaRedes = $sql->fetchAll(PDO::FETCH_ASSOC);
              foreach($listaRedes as $listR) {
          ?>
            <a href="<?php echo $listR['social_url'] ?>" title="<?php echo $listR['social_titulo'] ?>" target="_blank"><i class="<?php echo $listR['social_icone'] ?>"></i></a>
          <?php } ?> 
        </div>
        <div class="credits">
          <a href="https://sadigital.com.br/"><img src="<?php echo $baseUrl ?>assets/img/logo-SADigital.png" class="img-responsive" alt="SA Digital - Agência Digital" width="100px"></a>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


  <!-- Vendor JS Files -->
  <script src="<?php echo $baseUrl ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/jqueryMask/jquery.mask.min.js"></script>
  <script src="<?php echo $baseUrl ?>adm/dist/notiflix/notiflix-2.4.0.min.js"></script>
  <script src="<?php echo $baseUrl ?>assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo $baseUrl ?>assets/js/main.js"></script>

</body>

</html>

<script>
  AOS.init();
  $('#telefone').mask('(00) 0000-00009');

  $('#telefone').blur(function (event) {
      if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
          $('#telefone').mask('(00) 00000-0009');
      } else {
          $('#telefone').mask('(00) 0000-00009');
      }
  });
</script>