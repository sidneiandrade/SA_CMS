<?php
include './system/conexao.php';
include 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM SLIDES WHERE SD_ID = ?");
    $sql->execute([$ID]);
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dados as $value) {
        $Titulo = $value['sd_titulo'];
        $NomeImagem = $value['sd_imagem'];
        $UrlImagem = $value['sd_url_imagem'];
        $UrlBotao = $value['sd_url_botao'];
        $Texto = $value['sd_texto'];
        $Status = $value['sd_status'];
        $Acao = "Atualizar";
    }
} else {
    $ID = 0;
    $Titulo = "";
    $NomeImagem = "";
    $UrlImagem = "";
    $UrlBotao = "";
    $Texto = "";
    $Status = 1;
    $Acao = "Salvar";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Slide</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Slide</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Slide</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Slide</h1>
                </div>
            <?php } ?>
            <form id="formSlide" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Imagem</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="col-lg-12">
                                    <input type="hidden" id="Id" name="Id" value="<?php echo $ID ?>" />
                                    <div class="form-group">
                                        <input type="hidden" id="sdNomeImagem" name="sdNomeImagem" value="<?php echo $NomeImagem ?>">
                                        <?php if ($UrlImagem != "") { ?>
                                            <img src="<?php echo $UrlImagem ?>" class="img-fluid rounded mx-auto d-block mb-2" alt="<?php echo $Titulo ?>">
                                        <?php } ?>
                                        <label class="form-label" for="arquivoImagem">Enviar Imagem <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Tamanho Padrão 1500x600 pixels"></i></label>
                                        <input type="file" class="form-control" name="arquivoImagem">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do Slide</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label class="form-label" for="sdTitulo">Título</label>
                                            <input type="text" class="form-control" id="sdTitulo" name="sdTitulo" placeholder="Título do Slide" value="<?php echo $Titulo ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="sdStatus">Status</label>
                                            <select id="sdStatus" name="sdStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Publicado</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="sdTexto">Texto Slide</label>
                                            <textarea class="form-control" rows="5" id="sdTexto" name="sdTexto" placeholder="Texto Slide"><?php echo $Texto ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="sdBotao">Botão</label>
                                            <input type="url" class="form-control" id="sdBotao" name="sdBotao" placeholder="Botão do Slide" value="<?php echo $UrlBotao ?>">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarSlides" class="btn btn-pill btn-warning ml-1">Voltar</a>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<?php include 'footer.php'; ?>

<script>

    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    $("#formSlide").submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "./system/_slide.php",
            data: new FormData($('#formSlide')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Slide Salvo com Sucesso!');
                    setTimeout(function() {
                        location.href = "./slide?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Slide Atualizado com Sucesso!');
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


    function deletar() {
        event.preventDefault();

        Notiflix.Confirm.Show(
            'ATENÇÃO!',
            'Tem certeza que deseja deletar este Slide?',
            'Sim', 'Não',

            function() {

                let Id = $("#Id").val();
                let Titulo = $("#sdTitulo").val();
                let Imagem = $("#sdNomeImagem").val();
                let Texto = $("#sdTexto").val();
                let Botao = $("#sdBotao").val();
                let Status = $("#sdStatus").val();
                let Acao = "Deletar";

                $.ajax({
                    url: "./system/_slide.php",
                    data: {
                        'Id': Id,
                        'sdNomeImagem': Imagem,
                        'sdTitulo': Titulo,
                        'sdTexto': Texto,
                        'sdBotao': Botao,
                        'sdStatus': Status,
                        'Acao': Acao
                    },
                    type: "POST",
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Slide Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarSlides"
                            }, 2500);
                        } else {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Failure('Erro ao deletar!');
                        }
                    }
                });

            }
        );
    };
</script>