<?php
include './system/conexao.php';
include 'header.php';

$portID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($portID != 0) {
    $sql = $pdo->prepare("SELECT * FROM portfolios WHERE port_id = ?");
    $sql->execute([$portID]);
    $dadosPortfolio = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadosPortfolio as $value) {
        $Titulo = $value['port_nome'];
        $Slug = $value['port_slug'];
        $Empresa = $value['port_empresa'];
        $Categoria = $value['port_categoria'];
        $Texto = $value['port_texto'];
        $Url = $value['port_url'];
        $Status = $value['port_status'];
        $Acao = "Atualizar";
    }
} else {
    $Titulo = "";
    $Slug = "";
    $Empresa = "";
    $Categoria = 1;
    $Texto = "";
    $Url = "";
    $Status = 1;
    $Acao = "Salvar";
}


?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <?php if ($portID != 0) { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Portfólio</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Portfólio</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Portfólio</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Portfólio</h1>
                </div>
            <?php } ?>
            <form id="formPortfolio" method="post" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" id="portId" name="portId" value="<?php echo $portID ?>" />
                    <div class="col-lg-4">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Imagem</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="col-lg-12">
                                    <?php if ($portID != 0) { ?>
                                        <form id="editarGaleria" action="./system/_deletarImagem.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <?php
                                                $sqlImagem = $pdo->prepare("SELECT * FROM portfolio_imagem WHERE img_port_id = $portID");
                                                $sqlImagem->execute();
                                                $imagens = $sqlImagem->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($imagens as $vImagem) { ?>
                                                    <div class="col-lg-4">
                                                        <input type="hidden" id="portImagemId" name="portImagemId" value="<?php echo $vImagem['img_id'] ?>">
                                                        <input type="hidden" id="portImagemNome" name="portImagemNome" value="<?php echo $vImagem['img_nome'] ?>">
                                                        <img 
                                                            id="imgPortfolio" 
                                                            src="<?php echo $vImagem['img_imagem'] ?>" 
                                                            data-id="<?php echo $vImagem['img_id'] ?>" 
                                                            data-nome="<?php echo $vImagem['img_nome'] ?>" 
                                                            class="img-fluid rounded mb-2" 
                                                            alt="<?php echo $value['port_nome'] ?>" 
                                                            onclick="deletarImagem(this)" 
                                                            style="cursor:pointer;"
                                                            data-toggle="tooltip" 
                                                            data-placement="top" 
                                                            title="Clique na imagem para deletar.">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    <?php } ?>
                                    <label class="form-label" for="portImagem">Evniar Imagem <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Tamanho Padrão 800x800 pixels"></i></label>
                                    <input type="file" class="form-control" name="portImagem[]" multiple>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do Portfólio</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="portTitulo">Título Portfólio</label>
                                            <input type="text" class="form-control" id="portTitulo" name="portTitulo" placeholder="Título da Portfólio" value="<?php echo $Titulo ?>" required>
                                            <input type="hidden" name="portSlug" id="portSlug" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="portEmpresa">Empresa</label>
                                            <input type="text" class="form-control" id="portEmpresa" name="portEmpresa" placeholder="Empresa" value="<?php echo $Empresa ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="form-label" for="portTexto">Texto Portfólio</label>
                                            <div id="editor">
                                                <?php echo $Texto ?>
                                            </div>
                                            <input type="hidden" id="portTexto" name="portTexto" value="">
                                            <!-- <textarea class="form-control" rows="9" name="portTexto" placeholder="Texto do Portfólio"><?php echo $Texto ?></textarea> -->
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="portUrl">Url Projeto</label>
                                            <input type="url" class="form-control" id="portUrl" name="portUrl" placeholder="Url" value="<?php echo $Url ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="portCategoria">Categoria</label>
                                            <select name="portCategoria" class="form-control js-choice">
                                                <?php
                                                $sqlCategoria = $pdo->prepare("SELECT cat_id, cat_nome FROM categorias WHERE cat_origem = 'P' AND cat_status = 1");
                                                $sqlCategoria->execute();
                                                $categorias = $sqlCategoria->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($categorias as $key => $vCat) {
                                                    if ($vCat['cat_id'] == $value['port_categoria']) {
                                                        echo '<option value=' . $vCat['cat_id'] . ' selected="selected">' . $vCat['cat_nome'] . '</option>';
                                                    } else {
                                                        echo '<option value=' . $vCat['cat_id'] . '>' . $vCat['cat_nome'] . '</option>';
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="portStatus">Status</label>
                                            <select name="portStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Publicado</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($portID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarPortfolios" class="btn btn-pill btn-warning ml-1">Voltar</a>';
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

    $("#formPortfolio").submit(function() {
        event.preventDefault();
        
        $('#portSlug').val(getSlug($('#portTitulo').val()));
        
        var texto = $('#editor').summernote('code');
        $('#portTexto').val(texto);
        $.ajax({
            type: "POST",
            url: "./system/_portfolio.php",
            data: new FormData($('#formPortfolio')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Portfólio Salvo com Sucesso!');
                    setTimeout(function() {
                        location.href = "./portfolio?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Portfólio Atualizado com Sucesso!');
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

    function deletarImagem(e) {
        event.preventDefault();

        var IdImagem = e.getAttribute('data-id');
        var NomeImagem = e.getAttribute('data-nome');

        debugger;
        $.ajax({
            url: './system/_deletarImagem.php',
            data: {
                'portImagemId': IdImagem,
                'portImagemNome': NomeImagem
            },
            type: 'POST',
            success: function(data) {
                location.reload();
            }
        });

    }

    function deletar() {
        event.preventDefault();

        Notiflix.Confirm.Show(
            'ATENÇÃO!',
            'Tem certeza que deseja deletar esta notícia?',
            'Sim', 'Não',

            function() {

                let Id = $("#portId").val();
                let Titulo = "";
                let Empresa = "";
                let Slug = "";
                let Categoria = "";
                let Texto = "";
                let Status = "";
                let Acao = "Deletar";

                $.ajax({
                    url: "./system/_portfolio.php",
                    data: {
                        'portId': Id,
                        'portEmpresa': Empresa,
                        'portTitulo': Titulo,
                        'portSlug': Slug,
                        'portCategoria': Categoria,
                        'portTexto': Texto,
                        'portStatus': Status,
                        'Acao': Acao
                    },
                    type: "POST",
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Portfólio Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarPortfolios"
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