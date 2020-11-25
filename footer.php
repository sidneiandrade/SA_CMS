  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container d-md-flex py-4">
      <div class="col-lg-12 text-center">
        <div class="social-links pt-3 pb-3 pt-md-0">
          <?= ($values['conf_facebook'] != '') ? '<a href="'.$values['conf_facebook'].'" class="facebook"><i class="bx bxl-facebook"></i></a>' : '' ?> 
          <?= ($values['conf_instagram'] != '') ? '<a href="'.$values['conf_instagram'].'" class="instagram"><i class="bx bxl-instagram"></i></a>' : '' ?> 
          <?= ($values['conf_youtube'] != '') ? '<a href="'.$values['conf_youtube'].'" class="youtube"><i class="bx bxl-youtube"></i></a>' : '' ?> 
          <?= ($values['conf_linkedin'] != '') ? '<a href="'.$values['conf_linkedin'].'" class="linkedin"><i class="bx bxl-linkedin"></i></a>' : '' ?> 
        </div>
        <div class="copyright">
          <img src="<?php echo $values['conf_logo_url'] ?>" alt="<?php echo $values['conf_nome'] ?>" class="img-fluid" style="max-width: 250px"><br>
          <?php echo $values['conf_descricao'] ?>. Todos os direitos reservados.<br>
          <strong>CNPJ:</strong> <?php echo $values['conf_cnpj'] ?>
        </div>
        <div class="credits">
          <a href="https://sadigital.com.br/"><img src="./assets/img/logo-SADigital.png" class="img-responsive" alt="SA Digital - Agência Digital" width="100px"></a>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="./assets/vendor/jquery/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="./assets/vendor/php-email-form/validate.js"></script>
  <script src="./assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="./assets/vendor/counterup/counterup.min.js"></script>
  <script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./assets/vendor/venobox/venobox.min.js"></script>
  <script src="./assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="./assets/vendor/jqueryMask/jquery.mask.min.js"></script>
  <script src="./adm/dist/notiflix/notiflix-2.4.0.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<script>
  $('#telefone').mask('(00)00000-0000');
</script>