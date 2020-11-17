<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$usuID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($usuID != 0) {
    $sql = $pdo->prepare("SELECT * FROM usuario WHERE usu_id = ?");
    $sql->execute([$usuID]);
    $dadosUsuario = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dadosUsuario as $value) {
        $Nome = $value['usu_nome'];
        $Email = $value['usu_email'];
        $Status = $value['usu_status'];
        $Nivel = $value['usu_nivel'];
        $Erro = $value['usu_erro'];
        $Acao = "Atualizar";
    }
} else {
    $usuID = 0;
    $Nome = "";
    $Email = "";
    $Status = 1;
    $Nivel = 2;
    $Erro = "";
    $Acao = "Salvar";
}

?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <?php if ($usuID != 0) { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Usuário</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Usuário</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Usuário</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Usuário</h1>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Informações do Usuário</div>
                        </div>
                        <div class="card-body collapse show" id="cardCadastrar">
                            <form id="formUsuario" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" id="usuID" name="usuID" value="<?php echo $usuID ?>" />
                                        <div class="form-group">
                                            <label class="form-label" for="usuNome">Nome</label>
                                            <input type="text" class="form-control" id="usuaNome" name="usuNome" placeholder="Nome Usuário" value="<?php echo $Nome ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="usuEmail">E-mail</label>
                                            <input type="email" class="form-control" id="usuEmail" name="usuEmail" placeholder="E-mail" value="<?php echo $Email ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="usuSenha">Senha</label>
                                            <input type="password" class="form-control" id="usuSenha" name="usuSenha" placeholder="Senha">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="usuStatus">Status</label>
                                            <select id="usuStatus" name="usuStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Ativo</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if($_SESSION['nivel'] == 1){ ?>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="usuNivel">Nível</label>
                                            <select id="usuNivel" name="usuNivel" class="form-control js-choice">
                                                <option value="1" <?= ($Nivel == '1') ? 'selected="selected"' : '' ?>>Administrador</option>
                                                <option value="2" <?= ($Nivel == '2') ? 'selected="selected"' : '' ?>>Usuário</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="">Erros do Login</label>
                                            <input type="text" class="form-control" id="" name="" placeholder="" value="<?php echo $Erro ?>" disabled>
                                        </div>
                                    </div>

                                    <?php } ?>
                                </div>
                                <input type="hidden" id="Acao" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($usuID != 0) {
                                    echo '<a href="" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarUsuarios" class="btn btn-pill btn-warning ml-1">Voltar</a>';
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

    let Form = '#formUsuario';

    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    $(Form).submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "_usuario.php",
            data: new FormData($(Form)[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success(data.msg);
                    setTimeout(function() {
                        location.href = "./?id=" + (data.id)
                    }, 2500);
                } else if (data.acao == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success(data.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 2500);
                } else {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Failure(data.msg);
                }
            }
        });
    });


    function deletar() {
        event.preventDefault();

        Notiflix.Confirm.Show(
            'ATENÇÃO!',
            'Tem certeza que deseja deletar esta usuário?',
            'Sim', 'Não',

            function() {
                $("#Acao").val('Deletar');
                $.ajax({
                    type: "POST",
                    url: "_usuario.php",
                    data: new FormData($(Form)[0]),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data.acao == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success(data.msg);
                            setTimeout(function() {
                                location.href = "./listarUsuarios"
                            }, 2500);
                        } else {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Failure(data.msg);
                        }
                    }
                });

            }

        );
    };
</script>