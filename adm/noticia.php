<?php
include './system/conexao.php';
include 'header.php';

$notID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($notID != 0) {
    $sql = $pdo->prepare("SELECT * FROM noticias WHERE not_id = ?");
    $sql->execute([$notID]);
    $dadosNoticia = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadosNoticia as $value) {
        $Titulo = $value['not_titulo'];
        $Slug = $value['not_slug'];
        $NomeImagem = $value['not_nome_imagem'];
        $UrlImagem = $value['not_imagem'];
        $Texto = $value['not_texto'];
        $Categoria = $value['not_categoria'];
        $Status = $value['not_status'];
        $Acao = "Atualizar";
    }
} else {
    $notID = 0;
    $Titulo = "";
    $Slug = "";
    $NomeImagem = "";
    $UrlImagem = "";
    $Texto = "";
    $Categoria = "";
    $Status = 1;
    $Acao = "Salvar";
}

?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <?php if ($notID != 0) { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Notícia</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Notícia</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Notícia</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Notícia</h1>
                </div>
            <?php } ?>
            <form id="formNoticia" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Imagem</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="col-lg-12">
                                    <input type="hidden" id="notId" name="notId" value="<?php echo $notID ?>" />
                                    <div class="form-group">
                                        <input type="hidden" id="notNomeImagem" name="notNomeImagem" value="<?php echo $NomeImagem ?>">
                                        <?php if ($UrlImagem != "") { ?>
                                            <img src="<?php echo $UrlImagem ?>" class="img-fluid rounded mx-auto d-block mb-2" alt="<?php echo $Titulo ?>">
                                        <?php } ?>
                                        <label class="form-label" for="arquivoImagem">Enviar Imagem <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Tamanho Padrão 600x300 pixels"></i></label>
                                        <input type="file" class="form-control" name="arquivoImagem">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Ações</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="col-lg-12">
                                    <input type="hidden" name="Acao" value="<?php echo $Acao ?>">
                                    <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                    <?php if ($notID != 0) {
                                        echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                        echo '<a href="listarNoticias" class="btn btn-pill btn-warning ml-1">Voltar</a>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações da Notícia</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label class="form-label" for="notTitulo">Título Notícia</label>
                                            <input type="text" class="form-control" id="notTitulo" name="notTitulo" placeholder="Título da notícia" value="<?php echo $Titulo ?>" required>
                                            <input type="hidden" name="notSlug" id="notSlug" value="<?php echo $Slug ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="notCategoria">Categoria</label>
                                                <select name="notCategoria" class="form-control js-choice">
                                                    <?php
                                                    $sqlCategoria = $pdo->prepare("SELECT cat_id, cat_nome FROM categorias WHERE cat_origem = 'N' AND cat_status = 1");
                                                    $sqlCategoria->execute();
                                                    $categorias = $sqlCategoria->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($categorias as $key => $vCat) {
                                                        if ($vCat['cat_id'] == $value['not_categoria']) {
                                                            echo '<option value=' . $vCat['cat_id'] . ' selected="selected">' . $vCat['cat_nome'] . '</option>';
                                                        } else {
                                                            echo '<option value=' . $vCat['cat_id'] . '>' . $vCat['cat_nome'] . '</option>';
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="notStatus">Status</label>
                                                <select id="notStatus" name="notStatus" class="form-control js-choice">
                                                    <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Publicado</option>
                                                    <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="notTexto">Texto Notícia</label>
                                            <div id="editor">
                                                <?php echo $Texto ?>
                                            </div>
                                            <input type="hidden" id="notTexto" name="notTexto" value="">
                                        </div>
                                    </div>
                                </div>
                                
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

    $("#formNoticia").submit(function() {
        event.preventDefault();

        $('#notSlug').val(getSlug($('#notTitulo').val()));

        var texto = $('#editor').summernote('code');
        $('#notTexto').val(texto);

        $.ajax({
            type: "POST",
            url: "./system/_noticia.php",
            data: new FormData($('#formNoticia')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Notícia Salva com Sucesso!');
                    setTimeout(function() {
                        location.href = "./noticia?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Notícia Atualizada com Sucesso!');
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
            'Tem certeza que deseja deletar esta notícia?',
            'Sim', 'Não',

            function() {

                let Id = $("#notId").val();
                let Titulo = $("#notTitulo").val();
                let Imagem = $("#notNomeImagem").val();
                let Slug = $("#notSlug").val();
                let Texto = $("#notTexto").val();
                let Status = $("#notStatus").val();
                let Acao = "Deletar";

                $.ajax({
                    url: "./system/_noticia.php",
                    data: {
                        'notId': Id,
                        'notNomeImagem': Imagem,
                        'notTitulo': Titulo,
                        'notSlug': Slug,
                        'notTexto': Texto,
                        'notStatus': Status,
                        'Acao': Acao
                    },
                    type: "POST",
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Notícia Deletada com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarNoticias"
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