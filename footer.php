  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; <strong><span><?php echo $values['conf_nome'] ?></span></strong> - <?php echo $values['conf_descricao'] ?>. Todos os direitos reservados.
        </div>
        <div class="credits">
          <a href="https://sadigital.com.br/"><img src="./assets/img/logo-SADigital.png" class="img-responsive" alt="SA Digital - Agência Digital" width="10%"></a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <?= ($values['conf_facebook'] != '') ? '<a href="'.$values['conf_facebook'].'" class="facebook"><i class="bx bxl-facebook"></i></a>' : '' ?> 
        <?= ($values['conf_instagram'] != '') ? '<a href="'.$values['conf_instagram'].'" class="instagram"><i class="bx bxl-instagram"></i></a>' : '' ?> 
        <?= ($values['conf_youtube'] != '') ? '<a href="'.$values['conf_youtube'].'" class="youtube"><i class="bx bxl-youtube"></i></a>' : '' ?> 
        <?= ($values['conf_linkedin'] != '') ? '<a href="'.$values['conf_linkedin'].'" class="linkedin"><i class="bx bxl-linkedin"></i></a>' : '' ?> 
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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>