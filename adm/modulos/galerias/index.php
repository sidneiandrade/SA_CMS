<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Galeria</li>
                    </ol>
                </nav>
                <div class="pb-3">
                    <h1>Adicionar Galeria</h1>
                </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="_upload.php" class="dropzone" id="formDropzone" enctype="multipart/form-data">
                        <div class="fallback">
                          <input name="fileToUpload" type="file" multiple />
                        </div>
                    </form>
                    <br>
                    <div class="col-lg-2 offset-lg-5">
                        <button type="button" class="btn-warning btn btn-lg btn-block" onclick="atualizar()"><i class="fas fa-sync"></i> Carregar</button>
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Galeria</div>
                        </div>
                        <div class="card-body collapse show">
                            <div id="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $caminho . 'footer.php'; ?>

<script>

Dropzone.autoDiscover = false;

Dropzone.options.formDropzone = {
    paramName: "fileToUpload",
    dictDefaultMessage: "<h3><i class='fas fa-cloud-upload-alt'></i> Arraste seus arquivos!</h3>",
    dictFileTooBig: "Arquivo maior que 1mb",
    maxFilesize: 1,
    acceptedFiles: "image/*"
}

$(document).ready(function(){
    $("#formDropzone").dropzone();
    listar();
})

function atualizar(){
    location.reload();
}

function listar(){
    $.ajax({
        url: '_listaImagem',
        success: function(data){
            $("#preview").html(data);
        }
    })
}

$(document).on('click', '.remove_image', function(){
    var name = $(this).attr('id');
    $.ajax({
        url:"_listaImagem.php",
        method:"POST",
        data:{name:name},
        success:function(data){
            listar();
        }
    })
 });


    
</script>