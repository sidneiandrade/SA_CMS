<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM skills WHERE sk_id = ?");
    $sql->execute([$ID]);
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dados as $value) {
        $Titulo = $value['sk_titulo'];
        $Valor  = $value['sk_valor'];
        $Status = $value['sk_status'];
        $Acao   = "Atualizar";
    }
} else {
    $Titulo = "";
    $Valor  = "";
    $Status = "";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Skill</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Skill</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Skill</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Skill</h1>
                </div>
            <?php } ?>
            <form id="form" method="post" enctype="multipart/form-data" novalidate>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do Skill</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <input type="hidden" id="ID" name="ID" value="<?php echo $ID ?>" /> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="skTitulo">Titulo</label>
                                            <input type="text" class="form-control" id="skTitulo" name="skTitulo" placeholder="Título" value="<?php echo $Titulo ?>" required>
                                            <div class="invalid-feedback">Adicione um título.</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="skValor">Valor</label>
                                            <input type="number" class="form-control" id="skValor" name="skValor" placeholder="Valor" value="<?php echo $Valor ?>" required>
                                            <div class="invalid-feedback">Adicione um percentual.</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="skStatus">Status</label>
                                            <select id="skStatus" name="skStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Publicado</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <input type="hidden" id="Acao" name="Acao" value="<?php echo $Acao ?>">
                                <!-- <input type="submit" name="salvar" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="empresa" class="btn btn-pill btn-warning ml-1">Voltar</a>';
                                } ?> -->

                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $Acao ?></button>      
                                <?php if ($ID != 0) {
                                    echo '<a href="#" onclick="deletar()" class="btn btn-danger"><i class="far fa-trash-alt"></i> Deletar</a>';
                                    echo '<a href="empresa" class="btn btn-warning ml-1"><i class="fas fa-undo"></i> Voltar</a>';
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

    let FormSkill = "#form";

    window.addEventListener('load', function() {
        var form = document.getElementById('form');
        if(form !== null) {
            form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "_skill.php",
                    data: new FormData($(FormSkill)[0]),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data.acao == 'salvo') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Destaque Salva com Sucesso!');
                            setTimeout(function() {
                                location.href = "./skill?id=" + (data.id)
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
            }
            form.classList.add('was-validated');
            }, false);
        }
    }, false);

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
                    url: "_skill.php",
                    data: new FormData($(FormSkill)[0]),
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

        );
    };
</script>