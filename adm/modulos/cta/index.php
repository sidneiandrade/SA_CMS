<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$sql = $pdo->prepare("SELECT * FROM cta");
$sql->execute();
$dadosServico = $sql->fetchAll(PDO::FETCH_ASSOC);
$count = count($dadosServico);
if($count > 0){
    
    foreach ($dadosServico as $value) {
        $ID         = 1;
        $Titulo     = $value['cta_titulo'];
        $Texto      = $value['cta_texto'];
        $TextoBtn   = $value['cta_titulo_btn'];
        $UrlBtn     = $value['cta_url_btn'];
        $CorBtn     = $value['cta_cor_btn'];
        $Icone      = $value['cta_icone'];
        $Acao       = "Atualizar";
    }
} else {
    $ID         = 0;
    $Titulo     = "";
    $Texto      = "";
    $TextoBtn   = "";
    $UrlBtn     = "";
    $CorBtn     = "";
    $Icone      = "";
    $Acao       = "Salvar";
}


?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <?php if ($ID != 0) { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar CTA</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar CTA</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar CTA</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar CTA</h1>
                </div>
            <?php } ?>
            <form id="formCTA" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do CTA</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" id="ctaID" name="ctaID" value="<?php echo $ID ?>" />
                                        <div class="form-group">
                                            <label class="form-label" for="ctaTitulo">Titulo</label>
                                            <input type="text" class="form-control" id="ctaTitulo" name="ctaTitulo" placeholder="Título" value="<?php echo $Titulo ?>" required>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="ctaTexto">Texto</label>
                                            <textarea class="form-control" rows="5" id="ctaTexto" name="ctaTexto" placeholder="Texto"><?php echo $Texto ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-label" for="ctaIcone">Ícone</label>
                                            <button id="ctaIcone" name="ctaIcone" data-placement="right" data-icon="<?php echo $Icone ?>" class="btn btn-light btn-block" role="iconpicker"></button>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="ctaTituloBtn">Titulo Botão</label>
                                            <input type="text" class="form-control" id="ctaTituloBtn" name="ctaTituloBtn" placeholder="Título Botão" value="<?php echo $TextoBtn ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="ctaUrlBtn">URL Botão</label>
                                            <input type="text" class="form-control" id="ctaUrlBtn" name="ctaUrlBtn" placeholder="URL Botão" value="<?php echo $UrlBtn ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3 color">
                                        <label class="form-label" for="ctaCorBtn">Cor Botão</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="ctaCorBtn" name="ctaCorBtn" value="<?php echo $CorBtn ?>"/>
                                            <span class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="Acao" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" name="salvar" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include $caminho . 'footer.php'; ?>

<script>

    $(function () {
        $('.color').colorpicker({
            useAlpha: false
        });
    });

    let Form = '#formCTA';
    
    $(Form).submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "_cta.php",
            data: new FormData($(Form)[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('CTA Salva com Sucesso!');
                    setTimeout(function() {
                        location.href = "./?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('CTA Atualizada com Sucesso!');
                    setTimeout(function() {
                        location.reload();
                    }, 2500);
                } else {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Failure('Erro!');
                }
            }
        });
    });

</script>