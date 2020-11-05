<?php
include './system/conexao.php';
include 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM CLIENTES WHERE CLI_ID = ?");
    $sql->execute([$ID]);
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dados as $value) {
        $Empresa = $value['cli_empresa'];
        $NomeImagem = $value['cli_imagem'];
        $UrlImagem = $value['cli_url_imagem'];
        $Status = $value['cli_status'];
        $Acao = "Atualizar";
    }
} else {
    $ID = 0;
    $Empresa = "";
    $NomeImagem = "";
    $UrlImagem = "";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Cliente</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Cliente</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Cliente</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Cliente</h1>
                </div>
            <?php } ?>
            <form id="formCliente" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Logo do Cliente</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" id="Id" name="Id" value="<?php echo $ID ?>" />
                                        <div class="form-group">
                                            <input type="hidden" id="cliNomeImagem" name="cliNomeImagem" value="<?php echo $NomeImagem ?>">
                                            <?php if ($UrlImagem != "") { ?>
                                                <img src="<?php echo $UrlImagem ?>" class="img-fluid rounded mx-auto d-block mb-2" alt="<?php echo $Empresa ?>">
                                            <?php } ?>
                                            <label class="form-label" for="arquivoImagem">Enviar Imagem</label>
                                            <input type="file" class="form-control" name="arquivoImagem">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do Cliente</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label class="form-label" for="cliEmpresa">Empresa</label>
                                            <input type="text" class="form-control" id="cliEmpresa" name="cliEmpresa" placeholder="Nome da Empresa" value="<?php echo $Empresa ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="cliStatus">Status</label>
                                            <select id="cliStatus" name="cliStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Publicado</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <input type="hidden" id="Acao" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarClientes" class="btn btn-pill btn-warning ml-1">Voltar</a>';
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

    $("#formCliente").submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "./system/_cliente.php",
            data: new FormData($('#formCliente')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Cliente Salvo com Sucesso!');
                    setTimeout(function() {
                        location.href = "./cliente?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Cliente Atualizado com Sucesso!');
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
            'Tem certeza que deseja deletar este Cliente?',
            'Sim', 'Não',

            function() {
                $("#Acao").val('Deletar');
                $.ajax({
                    type: "POST",
                    url: "./system/_cliente.php",
                    data: new FormData($('#formCliente')[0]),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Cliente Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarClientes"
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