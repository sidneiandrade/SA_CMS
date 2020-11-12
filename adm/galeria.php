<?php
include './system/conexao.php';
include 'header.php';





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
                <div class="col-lg-6">
                    <form action="./system/upload.php" class="dropzone" id="formDropzone" enctype="multipart/form-data">
                        <div class="fallback">
                          <input name="fileToUpload" type="file" multiple />
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    
                </div>
            </div>
        </div>
    </div>
</div>




<?php include 'footer.php'; ?>

<script>

Dropzone.autoDiscover = false;

Dropzone.options.formDropzone = {
    paramName: "fileToUpload",
    dictDefaultMessage: "Arraste seus arquivos!",
    dictFileTooBig: "Arquivo maior que 1mb",
    maxFilesize: 1,
    acceptedFiles: "image/*",
    addRemoveLink: true,
    dictCancelUpload: true,
    dictCancelUpload: true,
    ConfirmationdictRemoveFile: true,
    renameFile: "Galeria-",
    accept: function(file, done) {
        done();
    }
}

$(document).ready(function(){
    $("#formDropzone").dropzone({ 
        url: "./system/upload.php"
    });
})


    
</script>