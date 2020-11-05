<?php
include './system/conexao.php';
include 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM SERVICOS WHERE SERV_ID = ?");
    $sql->execute([$ID]);
    $dadosServico = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadosServico as $value) {
        $Icone = $value['serv_icone'];
        $Titulo = $value['serv_titulo'];
        $Texto = $value['serv_texto'];
        $Acao = "Atualizar";
    }
} else {
    $Icone = "";
    $Titulo = "";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Serviço</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Serviço</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Serviço</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Serviço</h1>
                </div>
            <?php } ?>
            <form id="atualizarServico" action="./system/_servico.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do Serviço</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <input type="hidden" id="servID" name="servID" value="<?php echo $ID ?>" />
                                        <div class="form-group">
                                            <label class="form-label" for="servIcone">Ícone</label>
                                            <button id="servIcone" name="servIcone" data-placement="right" data-icon="<?php echo $Icone ?>" class="btn btn-light btn-block" role="iconpicker"></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <label class="form-label" for="servTitulo">Titulo Serviço</label>
                                            <input type="text" class="form-control" id="servTitulo" name="servTitulo" placeholder="Título do Serviço" value="<?php echo $Titulo ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="servTexto">Texto Serviço</label>
                                            <textarea class="form-control" rows="5" id="servTexto" name="servTexto" placeholder="Texto Serviço"><?php echo $Texto ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" name="salvar" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarServicos" class="btn btn-pill btn-warning ml-1">Voltar</a>';
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
    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    $("#atualizarServico").submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "./system/_servico.php",
            data: new FormData($('#atualizarServico')[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Serviço Salva com Sucesso!');
                    setTimeout(function() {
                        location.href = "./servico?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Serviço Atualizada com Sucesso!');
                    setTimeout(function() {
                        location.href = "./listarServicos"
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
            'Tem certeza que deseja deletar esta serviço?',
            'Sim', 'Não',

            function() {

                let Id = $("#servID").val();
                let Icone = "";
                let Titulo = "";
                let Texto = "";
                let Acao = "Deletar";

                $.ajax({
                    url: "./system/_servico.php",
                    data: {
                        'servID': Id,
                        'servIcone': Icone,
                        'servTitulo': Titulo,
                        'servTexto': Texto,
                        'Acao': Acao
                    },
                    type: "POST",
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Serviço Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarServicos"
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