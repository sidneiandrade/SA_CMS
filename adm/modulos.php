<?php
include './system/conexao.php';
include 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM MODULOS WHERE MOD_ID = ?");
    $sql->execute([$ID]);
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dados as $value) {
        $Titulo = $value['mod_titulo'];
        $Descricao = $value['mod_descricao'];
        $Status = $value['mod_status'];
        $Icone = $value['mod_icone'];
        $Url = $value['mod_url'];
        $Ordem = $value['mod_ordem'];
        $Acao = "Atualizar";
    }
} else {
    $ID = 0;
    $Titulo = "";
    $Descricao = "";
    $Status = 1;
    $Url = "";
    $Ordem = "";
    $Icone = "";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Modulo</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Modulo</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Modulo</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Modulo</h1>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Informações do Modulo</div>
                        </div>
                        <div class="card-body collapse show" id="cardCadastrar">
                            <form id="modulos" method="post" enctype="multipart/form-data" novalidate>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" id="usuID" name="ID" value="<?php echo $ID ?>" />
                                        <div class="form-group">
                                            <label class="form-label" for="Titulo">Nome</label>
                                            <input type="text" class="form-control" id="Titulo" name="Titulo" placeholder="Título" value="<?php echo $Titulo ?>" required>
                                            <div class="invalid-feedback">Adicione um título ao modulo.</div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="form-label" for="Descricao">Descricao</label>
                                            <input type="text" class="form-control" id="Descricao" name="Descricao" placeholder="Descricao" value="<?php echo $Descricao ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="Url">Url Lista</label>
                                            <input type="text" class="form-control" id="Url" name="Url" placeholder="Url" value="<?php echo $Url ?>" required>
                                            <div class="invalid-feedback">Adicione a url do modulo.</div>
                                        </div>

                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="Icone">Icone</label>
                                            <input type="text" class="form-control" id="Icone" name="Icone" placeholder="Icone" value="<?php echo $Icone ?>" required>
                                            <div class="invalid-feedback">Adicione o código do ícone.</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="Status">Status</label>
                                            <select id="Status" name="Status" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Ativo</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="Ordem">Ordem</label>
                                            <input type="number" class="form-control" id="Ordem" name="Ordem" placeholder="Ordem" value="<?php echo $Ordem ?>" required>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarModulos" class="btn btn-pill btn-warning ml-1">Voltar</a>';
                                } ?>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>

<script>
    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    window.addEventListener('load', function() {
    var form = document.getElementById('modulos');
    if(form !== null) {
        form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "./system/_modulos.php",
                data: new FormData($('#modulos')[0]),
                processData: false,
                contentType: false,
                success: function(data) {
                    Notiflix.Loading.Pulse('Carregando...');
                    debugger;
                    if (data.acao == 'salvo') {
                        Notiflix.Loading.Remove();
                        Notiflix.Notify.Success('Modulo Salvo com Sucesso!');
                        setTimeout(function() {
                            location.href = "./modulos?id=" + (data.id)
                        }, 2500);
                    } else if (data == 'atualizado') {
                        Notiflix.Loading.Remove();
                        Notiflix.Notify.Success('Modulo Atualizado com Sucesso!');
                        setTimeout(function() {
                            location.reload();
                        }, 2500);
                    } else {
                        Notiflix.Loading.Remove();
                        Notiflix.Notify.Failure('Erro!');
                    }
                }
            });
        }
        form.classList.add('was-validated');
        }, false);
    }
    }, false);

    function deletar() {
        event.preventDefault();

        Notiflix.Confirm.Show(
            'ATENÇÃO!',
            'Tem certeza que deseja deletar esta modulo?',
            'Sim', 'Não',

            function() {

                let Id = $("#usuID").val();
                let Titulo = "";
                let Descricao = "";
                let Url = "";
                let Icone = "";
                let Status = "";
                let Ordem = "";
                let Acao = "deletar";

                $.ajax({
                    url: "./system/_modulos.php",
                    data: {
                        'ID': Id,
                        'Titulo': Titulo,
                        'Descricao': Descricao,
                        'Url': Url,
                        'Icone': Icone,
                        'Status': Status,
                        'Ordem': Ordem,
                        'Acao': Acao
                    },
                    type: "POST",
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Modulo Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarModulos"
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