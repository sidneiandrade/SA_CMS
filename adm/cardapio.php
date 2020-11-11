<?php
include './system/conexao.php';
include 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM cardapios WHERE card_id = ?");
    $sql->execute([$ID]);
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dados as $value) {
        $Titulo = $value['card_titulo'];
        $NomeImagem = $value['card_imagem'];
        $UrlImagem = $value['card_url_imagem'];
        $Texto = $value['card_texto'];
        $Valor = $value['card_valor'];
        $Categoria = $value['card_categoria'];
        $Status = $value['card_status'];
        $Acao = "Atualizar";
    }
} else {
    $ID = 0;
    $Titulo = "";
    $NomeImagem = "";
    $UrlImagem = "";
    $Texto = "";
    $Valor = "";
    $Categoria = "";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Cardápio</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Cardápio</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Cardápio</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Cardápio</h1>
                </div>
            <?php } ?>
            <form id="formCardapio" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Imagem</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="col-lg-12">
                                    <input type="hidden" id="notId" name="notId" value="<?php echo $ID ?>" />
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
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações da Cardápio</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label class="form-label" for="cardTitulo">Título Notícia</label>
                                            <input type="text" class="form-control" id="cardTitulo" name="cardTitulo" placeholder="Título da notícia" value="<?php echo $Titulo ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="cardCategoria">Categoria</label>
                                                <select name="cardCategoria" class="form-control js-choice">
                                                    <?php
                                                    $sqlCategoria = $pdo->prepare("SELECT cat_id, cat_nome FROM categorias WHERE cat_origem = 'c' AND cat_status = 1");
                                                    $sqlCategoria->execute();
                                                    $categorias = $sqlCategoria->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($categorias as $key => $vCat) {
                                                        if ($vCat['cat_id'] == $value['card_categoria']) {
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
                                                <label class="form-label" for="cardStatus">Status</label>
                                                <select id="cardStatus" name="cardStatus" class="form-control js-choice">
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
                                <input type="hidden" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarCardapios" class="btn btn-pill btn-warning ml-1">Voltar</a>';
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

    $('#editor').summernote({
        placeholder: 'Texto...',
        tabsize: 2,
        height: 100
    });

    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    $("#formCardapio").submit(function() {
        event.preventDefault();

        var texto = $('#editor').summernote('code');
        $('#cardTexto').val(texto);

        $.ajax({
            type: "POST",
            url: "./system/_cardapio.php",
            data: new FormData($('#formCardapio')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Produto Salvo com Sucesso!');
                    setTimeout(function() {
                        location.href = "./cardapio?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Produto Atualizado com Sucesso!');
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