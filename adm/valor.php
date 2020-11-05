<?php
include './system/conexao.php';
include 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM VALORES WHERE VAL_ID = ?");
    $sql->execute([$ID]);
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dados as $key => $value) {
        $Titulo = $value['val_titulo'];
        $Valor = $value['val_valor'];
        $Frequencia = $value['val_frequencia'];
        $Texto = $value['val_texto'];
        $Url = $value['val_url'];
        $BtnTitulo = $value['val_btn_titulo'];
        $Destaque = $value['val_destaque'];
        $Status = $value['val_status'];
        $Acao = "Atualizar";
    }
} else {
    $ID = 0;
    $Titulo = "";
    $Valor = "";
    $Frequencia = "";
    $Texto = "";
    $Url = "";
    $BtnTitulo = "";
    $Destaque = 0;
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Valores</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Valores</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Valores</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Valores</h1>
                </div>
            <?php } ?>
            <form id="formValores" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações dos Valores</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" id="ID" name="ID" value="<?php echo $ID ?>" />
                                        <div class="form-group">
                                            <label class="form-label" for="valTitulo">Titulo</label>
                                            <input type="text" class="form-control" id="valTitulo" name="valTitulo" placeholder="Título" value="<?php echo $Titulo ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="valValor">Valor</label>
                                            <input type="text" class="form-control" id="valValor" name="valValor" placeholder="Valor" value="<?php echo $Valor ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="valFrequencia">Frequência</label>
                                            <select id="valFrequencia" name="valFrequencia" class="form-control js-choice">
                                                <option value="mensal" <?= ($Frequencia == 'mensal') ? 'selected="selected"' : '' ?>>mensal</option>
                                                <option value="trimestral" <?= ($Frequencia == 'trimestral') ? 'selected="selected"' : '' ?>>trimestral</option>
                                                <option value="anual" <?= ($Frequencia == 'anual') ? 'selected="selected"' : '' ?>>anual</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="valTexto">Texto</label>
                                            <div id="editor" style="height: 170px">
                                                <?php echo $Texto ?>
                                            </div>
                                            <input type="hidden" id="valTexto" name="valTexto" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="valUrl">URL</label>
                                                    <input type="text" class="form-control" id="valUrl" name="valUrl" placeholder="URL Botão" value="<?php echo $Url ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="valBtnTitulo">Título Botão</label>
                                                    <input type="text" class="form-control" id="valBtnTitulo" name="valBtnTitulo" placeholder="URL Botão" value="<?php echo $BtnTitulo ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="valDestaque">Destaque</label>
                                                    <select id="valDestaque" name="valDestaque" class="form-control js-choice">
                                                        <option value="1" <?= ($Destaque == '1') ? 'selected="selected"' : '' ?>>Sim</option>
                                                        <option value="0" <?= ($Destaque == '0') ? 'selected="selected"' : '' ?>>Não</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="valStatus">Status</label>
                                                    <select id="valStatus" name="valStatus" class="form-control js-choice">
                                                        <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Publicado</option>
                                                        <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="Acao" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" name="salvar" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarValores" class="btn btn-pill btn-warning ml-1">Voltar</a>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    var toolbarOptions = [
        ['bold', 'italic', 'strike']
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

    $("#formValores").submit(function() {
        event.preventDefault();
        var texto = quill.root.innerHTML.trim();
        $('#valTexto').val(texto);
        $.ajax({
            type: "POST",
            url: "./system/_valor.php",
            data: new FormData($('#formValores')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Valor Salvo com Sucesso!');
                    setTimeout(function() {
                        location.href = "./valor?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Valor Atualizado com Sucesso!');
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
            'Tem certeza que deseja deletar este Valor?',
            'Sim', 'Não',

            function() {
                $("#Acao").val('Deletar');
                $.ajax({
                    type: "POST",
                    url: "./system/_valor.php",
                    data: new FormData($('#formValores')[0]),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Valor Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarValores"
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