<?php
include './system/conexao.php';
include 'header.php';

$pagID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($pagID != 0) {
    $sql = $pdo->prepare("SELECT * FROM PAGINAS WHERE PAG_ID = ?");
    $sql->execute([$pagID]);
    $dadosPagina = $sql->fetchAll();
    foreach ($dadosPagina as $value) {
        $Titulo = $value['pag_titulo'];
        $NomeImagem = $value['pag_nome_imagem'];
        $UrlImagem = $value['pag_imagem'];
        $Texto = $value['pag_texto'];
        $Status = $value['pag_status'];
        $Acao = "Atualizar";
    }
} else {
    $pagID = 0;
    $Titulo = "";
    $NomeImagem = "";
    $UrlImagem = "";
    $Texto = "";
    $Status = 1;
    $Acao = "Salvar";
}


?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <?php if ($pagID != 0) { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Página</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Página</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Página</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Página</h1>
                </div>
            <?php } ?>
            <form id="atualizarPagina" action="./system/_pagina.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Imagem</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="col-lg-12">
                                    <input type="hidden" id="pagId" name="pagId" value="<?php echo $pagID ?>" />
                                    <div class="form-group">
                                        <input type="hidden" id="pagNomeImagem" name="pagNomeImagem" value="<?php echo $NomeImagem ?>">
                                        <?php if ($UrlImagem != "") { ?>
                                            <img src="<?php echo $UrlImagem ?>" class="img-fluid rounded mx-auto d-block mb-2" alt="<?php echo $Titulo ?>">
                                        <?php } ?>
                                        <label class="form-label" for="pagNovaImagem">Enviar Imagem</label>
                                        <input type="file" id="pagImagem" class="form-control" name="pagImagem">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações da Página</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <label class="form-label" for="pagTitulo">Título Página</label>
                                            <input type="text" class="form-control" id="pagTitulo" name="pagTitulo" placeholder="Título da Página" value="<?php echo $Titulo ?>" required>
                                            <input type="hidden" name="pagSlug" id="pagSlug" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-label" for="pagStatus">Status</label>
                                            <select id="pagStatus" name="pagStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Publicado</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pagTexto">Texto Página</label>
                                            <div id="editor">
                                                <?php echo $Texto ?>
                                            </div>
                                            <input type="hidden" id="pagTexto" name="pagTexto" value="">
                                            <!-- <textarea class="form-control" rows="7" id="pagTexto" name="pagTexto" placeholder="Texto da Página"><?php echo $Texto ?></textarea> -->
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($pagID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarPaginas" class="btn btn-pill btn-warning ml-1">Voltar</a>';
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
    var toolbarOptions = [
        ['bold', 'italic', 'blockquote'],  [{ 'list': 'ordered'}, { 'list': 'bullet' }], ['link', 'image'], ['clean'] 
    ];

    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    $('input[name=pagTitulo]').blur(function() {
        $('#pagSlug').val(getSlug($('#pagTitulo').val()));
    });

    $("#atualizarPagina").submit(function() {
        event.preventDefault();
        var texto = quill.root.innerHTML.trim();
        $('#pagTexto').val(texto);
        $.ajax({
            type: "POST",
            url: "./system/_pagina.php",
            data: new FormData($('#atualizarPagina')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Página Salva com Sucesso!');
                    setTimeout(function() {
                        location.href = "./pagina?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Página Atualizada com Sucesso!');
                    setTimeout(function() {
                        location.href = "./listarPaginas"
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
            'Tem certeza que deseja deletar esta página?',
            'Sim', 'Não',

            function() {

                let Id = $("#pagId").val();
                let Titulo = "";
                let Imagem = $("#pagNomeImagem").val();
                let Slug = "";
                let Texto = "";
                let Status = ""
                let Acao = "Deletar";

                $.ajax({
                    url: "./system/_pagina.php",
                    data: {
                        'pagId': Id,
                        'pagNomeImagem': Imagem,
                        'pagTitulo': Titulo,
                        'pagSlug': Slug,
                        'pagTexto': Texto,
                        'pagStatus': Status,
                        'Acao': Acao
                    },
                    type: "POST",
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Página Deletada com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarPaginas"
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