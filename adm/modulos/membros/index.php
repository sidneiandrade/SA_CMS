<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$ID = (isset($_GET['id']) ? $_GET['id'] : 0);

if ($ID != 0) {
    $sql = $pdo->prepare("SELECT * FROM membros WHERE mb_id = ?");
    $sql->execute([$ID]);
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dados as $value) {
        $Nome = $value['mb_nome'];
        $NomeImagem = $value['mb_imagem'];
        $UrlImagem = $value['mb_url_imagem'];
        $Cargo = $value['mb_cargo'];
        $Facebook = $value['mb_facebook'];
        $Twitter = $value['mb_twitter'];
        $Instagram = $value['mb_instagram'];
        $Linkedin = $value['mb_linkedin'];
        $Status = $value['mb_status'];
        $Acao = "Atualizar";
    }
} else {
    $ID = 0;
    $Nome = "";
    $NomeImagem = "";
    $UrlImagem = "";
    $Cargo = "";
    $Facebook = "";
    $Twitter = "";
    $Instagram = "";
    $Linkedin = "";
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
                        <li class="breadcrumb-item active" aria-current="page">Editar Membro</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Editar Membro</h1>
                </div>
            <?php } else { ?>
                <!-- BreadCrumb -->
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb adminx-page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar Membro</li>
                    </ol>
                </nav>

                <div class="pb-3">
                    <h1>Adicionar Membro</h1>
                </div>
            <?php } ?>
            <form id="formMembro" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Foto</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" id="Id" name="Id" value="<?php echo $ID ?>" />
                                        <div class="form-group">
                                            <input type="hidden" id="mbNomeImagem" name="mbNomeImagem" value="<?php echo $NomeImagem ?>">
                                            <?php if ($UrlImagem != "") { ?>
                                                <img src="<?php echo $UrlImagem ?>" class="img-fluid rounded mx-auto d-block mb-2" alt="<?php echo $Nome ?>">
                                            <?php } ?>
                                            <label class="form-label" for="arquivoImagem">Enviar Imagem <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Tamanho Padrão 600x600 pixels"></i></label>
                                            <input type="file" class="form-control" id="arquivoImagem" name="arquivoImagem">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do Membro</div>
                            </div>
                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="mbNome">Nome</label>
                                            <input type="text" class="form-control" id="mbNome" name="mbNome" placeholder="Nome" value="<?php echo $Nome ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="mbCargo">Cargo</label>
                                            <input type="text" class="form-control" id="mbCargo" name="mbCargo" placeholder="Cargo/Função" value="<?php echo $Cargo ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="mbFacebook">Facebook</label>
                                            <input type="text" class="form-control" id="mbFacebook" name="mbFacebook" placeholder="https://facebook.com/" value="<?php echo $Facebook ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="mbTwitter">Twitter</label>
                                            <input type="text" class="form-control" id="mbTwitter" name="mbTwitter" placeholder="https://twitter.com/" value="<?php echo $Twitter ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="mbInstagram">Instagram</label>
                                            <input type="text" class="form-control" id="mbInstagram" name="mbInstagram" placeholder="https://instagram.com/" value="<?php echo $Instagram ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="mbLinkedin">Linkedin</label>
                                            <input type="text" class="form-control" id="mbLinkedin" name="mbLinkedin" placeholder="https://linkedin.com/" value="<?php echo $Linkedin ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="mbStatus">Status</label>
                                            <select id="mbStatus" name="mbStatus" class="form-control js-choice">
                                                <option value="1" <?= ($Status == '1') ? 'selected="selected"' : '' ?>>Ativo</option>
                                                <option value="0" <?= ($Status == '0') ? 'selected="selected"' : '' ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <input type="hidden" id="Acao" name="Acao" value="<?php echo $Acao ?>">
                                <input type="submit" class="btn btn-pill btn-primary" value="<?php echo $Acao ?>" />
                                <?php if ($ID != 0) {
                                    echo '<a href="" onclick="deletar()" class="btn btn-pill btn-danger">Deletar</a>';
                                    echo '<a href="listarMembros" class="btn btn-pill btn-warning ml-1">Voltar</a>';
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


<?php include $caminho . 'footer.php'; ?>

<script>

    let Form = '#formMembro';

    Notiflix.Confirm.Init({
        titleColor: "#c63232",
        okButtonBackground: "#c63232",
        backOverlayColor: "rgba(255,85,73,0.2)",
    });

    $(Form).submit(function() {
        event.preventDefault();

        if($("#arquivoImagem")[0].files.length > 0){
            var imagem = $("#arquivoImagem")[0].files[0].size;
            if(imagem > 1024000) {
                Notiflix.Notify.Warning('Não é permitido enviar arquivo maior que 1MB');
                return false
            }
        }

        $.ajax({
            type: "POST",
            url: "_membro.php",
            data: new FormData($(Form)[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.acao == 'salvo') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Membro Salvo com Sucesso!');
                    setTimeout(function() {
                        location.href = "./?id=" + (data.id)
                    }, 2500);
                } else if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Membro Atualizado com Sucesso!');
                    setTimeout(function() {
                        location.reload();
                    }, 2500);
                } else if (data.error == 'imagemGrande'){
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Failure(data.mensagem);
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
            'Tem certeza que deseja deletar este Membro?',
            'Sim', 'Não',

            function() {
                $("#Acao").val('Deletar');
                $.ajax({
                    type: "POST",
                    url: "_membro.php",
                    data: new FormData($(Form)[0]),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Notiflix.Loading.Pulse('Carregando...');
                        debugger;
                        if (data == 'deletado') {
                            Notiflix.Loading.Remove();
                            Notiflix.Notify.Success('Membro Deletado com Sucesso!');
                            setTimeout(function() {
                                location.href = "./listarMembros"
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