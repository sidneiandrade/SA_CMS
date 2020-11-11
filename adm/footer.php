<nav class="navbar fixed-bottom navbar-dark bg-dark">
    <div class="col-lg-12 text-right">
        <a class="navbar-brand" href="https://sadigital.com.br" target="_blank" style="font-size: 8px">
            <img src="../assets/img/logo-jumper-cms.svg" class="img-fluid" alt="JUMPER CMS" width="20%"> V1.0
            <br>Desenvolvido por SA Digital
        </a>
    </div>
  
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="./dist/js/vendor.js"></script>
<script src="./dist/js/adminx.js"></script>
<script src="./dist/notiflix/notiflix-2.4.0.min.js"></script>
<script src="./dist/notiflix/notiflix-aio-2.4.0.min.js"></script>
<script src="./dist/dataTable/jquery.dataTables.min.js"></script>
<script src="./dist/dataTable/dataTables.bootstrap4.min.js"></script>
<script src="./dist/icons/js/bootstrap-iconpicker.bundle.min.js"></script>
<script src="./dist/js/slug.js"></script>
<script src="./dist/colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="./dist/summernote/summernote-bs4.js"></script>
<script src="./dist/summernote/lang/summernote-pt-BR.min.js"></script>

</body>

</html>

<script>
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
</script>