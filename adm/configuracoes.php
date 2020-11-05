<?php

include './system/conexao.php';

// $sql = $pdo->prepare("SELECT * FROM CONFIGURACOES WHERE CONF_ID = 1");
// $sql->execute();
// $listarConfiguracoes = $sql->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';

?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Configurações do Site</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Editar Configurações do Site</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Informações do Site</div>
                        </div>
                        <div class="card-body collapse show">
                            <form id="configuracoes" action="./system/_configuracoes.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php foreach ($listarConfiguracoes as $key => $value) { ?>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">Logo</label> <small>Tamanho Padrão 500x135 pixels</small><br>
                                                <img class="img-fluid" src="<?php echo $value['conf_logo'] ?>" alt="<?php echo $value['conf_nome'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Favicon</label> <small>Tamanho Padrão 32x32 pixels</small><br>
                                                <img src="<?php echo $value['conf_favicon'] ?>" alt="<?php echo $value['conf_nome'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="confLogo">Atualizar Logo</label>
                                                <input type="file" class="form-control" id="confLogo" name="confLogo" />
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="confFavicon">Atualizar Favicon</label>
                                                <input type="file" class="form-control" id="confFavicon" name="confFavicon" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confNome">Nome do Site</label>
                                                <input type="text" class="form-control" name="confNome" value="<?php echo $value['conf_nome'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confDescricao">Descrição do Site</label>
                                                <input type="text" class="form-control" name="confDescricao" value="<?php echo $value['conf_descricao'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confTelefone">Contatos</label>
                                                <input type="text" class="form-control" name="confTelefone" value="<?php echo $value['conf_telefone'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confEmail">E-mail</label>
                                                <input type="text" class="form-control" name="confEmail" value="<?php echo $value['conf_email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confLink">Link</label>
                                                <input type="text" class="form-control" name="confLink" value="<?php echo $value['conf_link'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <label class="form-label" for="confEndereco">Endereço</label>
                                                <input type="text" class="form-control" name="confEndereco" value="<?php echo $value['conf_endereco'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confInstagram">Instagram</label>
                                                <input type="text" class="form-control" name="confInstagram" value="<?php echo $value['conf_instagram'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confFacebook">Facebook</label>
                                                <input type="text" class="form-control" name="confFacebook" value="<?php echo $value['conf_facebook'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confYoutube">Youtube</label>
                                                <input type="text" class="form-control" name="confYoutube" value="<?php echo $value['conf_youtube'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confLinkedin">LinkedIn</label>
                                                <input type="text" class="form-control" name="confLinkedin" value="<?php echo $value['conf_linkedin'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 color">
                                        <label class="form-label" for="confCorPrincipal">Cor Principal</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="confCorPrincipal" value="<?php echo $value['conf_cor_principal'] ?>"/>
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 color">
                                        <label class="form-label" for="confCorSecundaria">Cor Secundaria</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="confCorSecundaria" value="<?php echo $value['conf_cor_secundaria'] ?>"/>
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div> -->

                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Ativa ou Desativar Modulos</div>
                        </div>
                        <div class="card-body collapse show">
                        <form id="configuracoes" action="./system/_configuracoes.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php 
                                        
                                        $lista = $pdo->query("SELECT * FROM MODULOS")->fetchAll(PDO::FETCH_ASSOC);
                                        $i = 0;
                                        foreach($lista as $value){

                                        ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input 
                                                    type="checkbox" 
                                                    class="custom-control-input" 
                                                    id="modulo_<?php echo $i ?>" 
                                                    name="modulos" 
                                                    data-id="<?php echo $value['mod_id'] ?>"
                                                    <?= ($value['mod_status'] == 1) ? 'checked="checked"' : '' ?>/>
                                                <label class="custom-control-label" for="modulo_<?php echo $i ?>">Ativar <?php echo $value['mod_titulo'] ?></label>
                                            </div>
                                        </div>

                                        <?php $i++; } ?>
                                    </div>
                                    
                                </div>
                                <br>
                                <input type="submit" class="btn btn-pill btn-primary" value="Atualizar Configurações" />
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>

<script>

    $(function () {
        $('.color').colorpicker({
            useAlpha: false
        });
    });

    $("#configuracoes").submit(function() {
        event.preventDefault();
        Notiflix.Loading.Pulse('Carregando...');

        var lista = $('input[name="modulos"]').toArray().map(function (check) {
            return $(check).val();
        });

        var total = lista.length;
        debugger;
        for(var i = 0; i < total; i++){
            var modulo = $("#modulo_" + i).is(':checked');
            var id = $("#modulo_" + i).attr("data-id");
            if(modulo == true){
                var acao = "adicionar";
                $.ajax({
                    type: "POST",
                    url: "./system/_modulos.php",
                    datatype: "json",
                    data: "ID=" + id + "&Acao=" + acao,
                    success: function(data) {},
                    error: function () {}
                });
            } else {
                var acao = "retirar";
                $.ajax({
                    type: "POST",
                    url: "./system/_modulos.php",
                    datatype: "json",
                    data: "ID=" + id + "&Acao=" + acao,
                    success: function(data) {},
                    error: function () {}
                });
            }
        }
                

        Notiflix.Loading.Remove();
        Notiflix.Notify.Success('Configurações Atualizadas com Sucesso!');
        setTimeout(function() {
            location.reload();
        }, 2500);
    });

    // $("#configuracoes").submit(function() {
    //     event.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: "./system/_configuracoes.php",
    //         data: new FormData($('#configuracoes')[0]),
    //         processData: false,
    //         contentType: false,
    //         success: function(data) {
    //             Notiflix.Loading.Pulse('Carregando...');

    //             var lista = $('input[name="modulos"]').toArray().map(function (check) {
    //                 return $(check).val();
    //             });

    //             var total = lista.length;
    //             debugger;
    //             for(var i = 0; i < total; i++){
    //                 var modulo = $("#modulo_" + i).is(':checked');
    //                 var id = $("#modulo_" + i).attr("data-id");
    //                 if(modulo == true){
    //                     var acao = "adicionar";
    //                     $.ajax({
    //                         type: "POST",
    //                         url: "./system/_modulos.php",
    //                         datatype: "json",
    //                         data: "ID=" + id + "&Acao=" + acao,
    //                         success: function(data) {},
    //                         error: function () {}
    //                     });
    //                 } else {
    //                     var acao = "retirar";
    //                     $.ajax({
    //                         type: "POST",
    //                         url: "./system/_modulos.php",
    //                         datatype: "json",
    //                         data: "ID=" + id + "&Acao=" + acao,
    //                         success: function(data) {},
    //                         error: function () {}
    //                     });
    //                 }
    //             }
                
    //             if (data == 'sucesso') {
    //                 Notiflix.Loading.Remove();
    //                 Notiflix.Notify.Success('Configurações Atualizadas com Sucesso!');
    //                 setTimeout(function() {
    //                     location.reload();
    //                 }, 2500);
    //             } else {
    //                 Notiflix.Loading.Remove();
    //                 Notiflix.Notify.Failure('Erro ao atualizar!');
    //             }
    //             setTimeout(function() {
    //                 location.reload()
    //             }, 2000);
    //         }
    //     });
    // });
</script>