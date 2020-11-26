<nav class="navbar fixed-bottom navbar-dark bg-dark">
    <div class="offset-lg-1 col-lg-2 white">
        <div id="demo" style="color: #fff"></div>
    </div>
    <div class="col-lg-6 text-right">
        <a class="navbar-brand" href="https://sadigital.com.br" target="_blank" style="font-size: 8px">
            <img src="<?php echo $baseUrl ?>assets/img/logo-jumper-cms.svg" class="img-fluid" alt="JUMPER CMS" width="20%"> V1.0
            <br>Desenvolvido por SA Digital
        </a>
    </div>
    
  
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/js/vendor.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/js/adminx.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/notiflix/notiflix-2.4.0.min.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/notiflix/notiflix-aio-2.4.0.min.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/dataTable/jquery.dataTables.min.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/icons/js/bootstrap-iconpicker.bundle.min.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/js/slug.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/summernote/summernote-bs4.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/summernote/lang/summernote-pt-BR.min.js"></script>
<script src="<?php echo $baseUrl ?>adm/dist/dropzone/dropzone.min.js"></script>
<script src="<?php echo $baseUrl ?>assets/vendor/jqueryMask/jquery.mask.min.js"></script>

</body>

</html>

<script>
    
    Notiflix.Loading.Pulse('Carregando...');

    $(window).on("load", function() {   
        Notiflix.Loading.Remove();
    });

    $(document).ajaxStart(function () { 
        Notiflix.Loading.Pulse('Carregando...');
    });

    $(document).ajaxStop(function () {
        Notiflix.Loading.Remove();
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('#editor').summernote({
        placeholder: 'Texto...',
        tabsize: 2,
        height: 400,
        lang: 'pt-BR',
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['picture', 'link', 'video']],
            ['view', ['fullscreen']]
        ]
    });


    var time = $('#time').val();
    // Set the date we're counting down to
    var countDownDate = new Date(time).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    var text = "Sua sessão expira em  "

    // Display the result in the element with id="demo"
    document.getElementById("demo").innerHTML =  text + minutes + "m " + seconds + "s ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Expirado";
        //window.location.reload();
    }
    }, 1000);
</script>