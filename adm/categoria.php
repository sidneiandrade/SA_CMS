<?php
include './system/conexao.php';
include 'header.php';

$catID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($catID != 0) {
    $sql = $pdo->prepare("SELECT * FROM CATEGORIAS WHERE CAT_ID = ?");
    $sql->execute([$catID]);
    $dadosCategoria = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadosCategoria as $value) {
        $Nome = $value['cat_nome'];
        $Slug = $value['cat_slug'];
        $Origem = $value['cat_origem'];
        $Status = $value['cat_status'];
        $Acao = "Atualizar";
    }
} else {
    $Id = 0;
    $Nome = "";
    $Slug = "";
    $Origem = "";
    $Status = 1;
    $Acao = "Salvar";
}

?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <?php if ($catID != 0) { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Categoria</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Categoria</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Categoria</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Categoria</h1>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Informações da Categoria</div>
                        </div>
                        <div class="card-body collapse show" id="cardCadastrar">
                            <form id="formCategoria" action="./system/_categoria.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" id="catID" name="catID" value="<?php echo $catID ?>" />
                                        <div class="form-group">
                                            <label class="form-label" for="catNome">Categoria</label>
                                            <input type="text" class="form-control" id="catNome" name="catNome" placeholder="Nome Categoria" value="<?php echo $Nome ?>" required>
                                            <input type="hidden" id="catSlug" name="catSlug" value="<?php echo $Slug ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="catOrigem">Status</label>
                                            <select id="catOrigem" name="catOrigem" class="form-control js-choice">
                                                <option value="n" <?= ($Origem == 'n') ? 'selected="selected"' : '' ?>>Notícias</option>
                                                <option value="p" <?= ($Origem == 'p') ? 'selected="selected"' : '' ?>>Portfólio</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="catStatus">Status</label>
                                            <select id="catStatus" name="catStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Ativo</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($catID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarCategorias" class="btn btn-pill btn-warning ml-1">Voltar</a>';
                                } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    $('input[name=catNome]').blur(function() {
        $('#catSlug').val(getSlug($('#catNome').val()));
    });

    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    $("#formCategoria").submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "./system/_categoria.php",
            data: new FormData($('#formCategoria')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Categoria Salva com Sucesso!');
                    setTimeout(function() {
                        location.href = "./categoria?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Categoria Atualizada com Sucesso!');
                    setTimeout(function() {
                        location.href = "./listarCategorias"
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
            'Tem certeza que deseja deletar esta Categoria?',
            'Sim', 'Não',

            function() {

                let Id = $("#catID").val();
                let Nome = $("#catNome").val();
                let Slug = $("#catSlug").val();
                let Status = $("#catStatus").val();
                let Acao = "Deletar";

                $.ajax({
                    url: "./system/_categoria.php",
                    data: {
                        'catID': Id,
                        'catNome': Nome,
                        'catSlug': Slug,
                        'catStatus': Status,
                        'Acao': Acao
                    },
                    type: "POST",
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Categoria Deletada com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarCategorias"
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