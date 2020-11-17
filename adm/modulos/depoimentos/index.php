<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM depoimentos WHERE dep_id = ?");
    $sql->execute([$ID]);
    $dadosDepoimento = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadosDepoimento as $value) {
        $Nome = $value['dep_nome'];
        $Empresa = $value['dep_empresa'];
        $Texto = $value['dep_texto'];
        $Acao = "Atualizar";
    }
} else {
    $ID = 0;
    $Nome = "";
    $Empresa = "";
    $Texto = "";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Depoimento</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Depoimento</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Depoimento</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Depoimento</h1>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Informações do Depoimento</div>
                        </div>
                        <div class="card-body collapse show" id="cardCadastrar">
                            <form id="atualizarDepoimento" action="./system/_depoimento.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" id="depID" name="depID" value="<?php echo $ID ?>" />
                                        <div class="form-group">
                                            <label class="form-label" for="depNome">Nome</label>
                                            <input type="text" class="form-control" id="depNome" name="depNome" placeholder="Nome" value="<?php echo $Nome ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="depEmpresa">Empresa</label>
                                            <input type="text" class="form-control" id="depEmpresa" name="depEmpresa" placeholder="Empresa" value="<?php echo $Empresa ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="depTexto">Depoimento</label>
                                            <textarea class="form-control" rows="5" id="depTexto" name="depTexto" placeholder="Texto Depoimento"><?php echo $Texto ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="Acao" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarDepoimentos" class="btn btn-pill btn-warning ml-1">Voltar</a>';
                                } ?>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $caminho . 'footer.php'; ?>

<script>

    let Form = '#atualizarDepoimento';

    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    $(Form).submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "_depoimento.php",
            data: new FormData($(Form)[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Depoimento Salva com Sucesso!');
                    setTimeout(function() {
                        location.href = "?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Depoimento Atualizada com Sucesso!');
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
            'Tem certeza que deseja deletar esta depoimento?',
            'Sim', 'Não',

            function() {
                $("#Acao").val('Deletar');
                $.ajax({
                    type: "POST",
                    url: "_depoimento.php",
                    data: new FormData($(Form)[0]),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Depoimento Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarDepoimentos"
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