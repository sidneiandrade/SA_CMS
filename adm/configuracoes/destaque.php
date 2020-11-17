<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM destaque WHERE des_id = ? AND des_emp_id = ?");
    $sql->execute([$ID, 1]);
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dados as $value) {
        $Icone  = $value['des_icone'];
        $Titulo = $value['des_titulo'];
        $Texto  = $value['des_texto'];
        $Status = $value['des_status'];
        $Acao   = "Atualizar";
    }
} else {
    $Icone  = "";
    $Titulo = "";
    $Texto  = "";
    $Status = 1;
    $Acao   = "Salvar";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Destaque</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Destaque</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Destaque</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Destaque</h1>
                </div>
            <?php } ?>
            <form id="form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do Destaque</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <input type="hidden" id="desID" name="desID" value="<?php echo $ID ?>" />
                                        <div class="form-group">
                                            <label class="form-label" for="desIcone">Ícone</label>
                                            <button id="desIcone" name="desIcone" data-placement="right" data-icon="<?php echo $Icone ?>" class="btn btn-light btn-block" role="iconpicker"></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label class="form-label" for="desTitulo">Titulo Destaque</label>
                                            <input type="text" class="form-control" id="desTitulo" name="desTitulo" placeholder="Título do Destaque" value="<?php echo $Titulo ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="desStatus">Status</label>
                                            <select id="desStatus" name="desStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Publicado</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="desTexto">Texto Destaque</label>
                                            <textarea class="form-control" rows="5" id="desTexto" name="desTexto" placeholder="Texto Destaque"><?php echo $Texto ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="Acao" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" name="salvar" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="empresa" class="btn btn-pill btn-warning ml-1">Voltar</a>';
                                } ?>
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
    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    let Form = "#form";

    $(Form).submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "_destaque.php",
            data: new FormData($(Form)[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Destaque Salva com Sucesso!');
                    setTimeout(function() {
                        location.href = "./destaque?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Destaque Atualizada com Sucesso!');
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
            'Tem certeza que deseja deletar esta destaque?',
            'Sim', 'Não',

            function() {
                $("#Acao").val('Deletar');
                $.ajax({
                    type: "POST",
                    url: "_destaque.php",
                    data: new FormData($(Form)[0]),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Destaque Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./empresa"
                            }, 2500);
                        } else {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Failure('Erro ao deletar!');
                        }
                    }
                });

            }

            // function() {

            //     let Id = $("#desID").val();
            //     let Icone = "";
            //     let Titulo = "";
            //     let Texto = "";
            //     let Status = "";
            //     let Acao = "Deletar";

            //     $.ajax({
            //         url: "_destaque.php",
            //         data: {
            //             'desID': Id,
            //             'desIcone': Icone,
            //             'desTitulo': Titulo,
            //             'desTexto': Texto,
            //             'desStatus': Status,
            //             'Acao': Acao
            //         },
            //         type: "POST",
            //         success: function(data) {
            //             Notiflix.Loading.Pulse('Carregando...');
            //             debugger;
            //             if (data == 'deletado') {
            //                 Notiflix.Loading.Remove();
            //                 Notiflix.Notify.Success('Destaque Deletado com Sucesso!');
            //                 setTimeout(function() {
            //                     location.href = "./empresa";
            //                 }, 2500);
            //             } else {
            //                 Notiflix.Loading.Remove();
            //                 Notiflix.Notify.Failure('Erro ao deletar!');
            //             }
            //         }
            //     });

            // }
        );
    };
</script>