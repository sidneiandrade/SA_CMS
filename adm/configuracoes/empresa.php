<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$sql = $pdo->prepare("SELECT * FROM configuracoes WHERE conf_id = 1");
$sql->execute();
$listarConfiguracoes = $sql->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Empresa</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Empresa</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Informações do Site</div>
                        </div>
                        <div class="card-body collapse show">
                            <form id="configuracoes" action="./system/_configuracoes.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php foreach ($listarConfiguracoes as $key => $value) { ?>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">Logo <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Tamanho Padrão 500x150 pixels"></i></label><br>
                                                <img class="img-fluid" src="<?php echo $value['conf_logo_url'] ?>" alt="<?php echo $value['conf_nome'] ?>">
                                                <input type="hidden" name="nomeLogo" value="<?php echo $value['conf_logo']?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Favicon <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Tamanho Padrão 32x32 pixels"></i></label><br>
                                                <img src="<?php echo $value['conf_favicon_url'] ?>" alt="<?php echo $value['conf_nome'] ?>">
                                                <input type="hidden" name="nomeFavicon" value="<?php echo $value['conf_favicon']?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="confLogo">Atualizar Logo</label>
                                                <input type="file" class="form-control" id="confLogo" name="confLogo" />
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="confFavicon">Atualizar Favicon</label>
                                                <input type="file" class="form-control" id="confFavicon" name="confFavicon" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confNome">Nome do Site</label>
                                                <input type="text" class="form-control" name="confNome" value="<?php echo $value['conf_nome'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confDescricao">Descrição do Site</label>
                                                <input type="text" class="form-control" name="confDescricao" value="<?php echo $value['conf_descricao'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confTelefone">Contatos</label>
                                                <input type="text" class="form-control" name="confTelefone" value="<?php echo $value['conf_telefone'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confEmail">E-mail</label>
                                                <input type="text" class="form-control" name="confEmail" value="<?php echo $value['conf_email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confLink">Link</label>
                                                <input type="text" class="form-control" name="confLink" value="<?php echo $value['conf_link'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <label class="form-label" for="confEndereco">Endereço</label>
                                                <input type="text" class="form-control" name="confEndereco" value="<?php echo $value['conf_endereco'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confInstagram">Instagram</label>
                                                <input type="text" class="form-control" name="confInstagram" value="<?php echo $value['conf_instagram'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confFacebook">Facebook</label>
                                                <input type="text" class="form-control" name="confFacebook" value="<?php echo $value['conf_facebook'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confYoutube">Youtube</label>
                                                <input type="text" class="form-control" name="confYoutube" value="<?php echo $value['conf_youtube'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="confLinkedin">LinkedIn</label>
                                                <input type="text" class="form-control" name="confLinkedin" value="<?php echo $value['conf_linkedin'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 color">
                                            <label class="form-label" for="confCorPrincipal">Cor Principal</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="confCorPrincipal" value="<?php echo $value['conf_cor_principal'] ?>"/>
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 color">
                                            <label class="form-label" for="confCorSecundaria">Cor Título</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="confCorSecundaria" value="<?php echo $value['conf_cor_secundaria'] ?>"/>
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mt-4">
                                        <input type="submit" class="btn btn-pill btn-primary" value="Atualizar Configurações" />
                                    </div>
                                </div>
                                
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Sobre a Empresa</div>
                        </div>
                        <div class="card-body collapse show">
                            <form id="empresa" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php 
                                    
                                    $empresa = $pdo->query("SELECT * FROM empresa")->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($empresa as $empValue){}
                                    ?>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Imagem</label> <small>Tamanho Padrão 540x370 pixels</small><br>
                                                <img class="img-fluid" src="<?php echo $empValue['emp_url_imagem'] ?>" alt="<?php echo $value['conf_nome'] ?>">
                                                <input type="hidden" name="nomeImagem" value="<?php echo $empValue['emp_imagem'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="empImagem">Atualizar</label>
                                                <input type="file" class="form-control" id="empImagem" name="empImagem" />
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label class="form-label" for="empDescricao">Descrição da Empresa</label>
                                                <div id="editor">
                                                    <?php echo $empValue['emp_descricao'] ?>
                                                </div>
                                                <input type="hidden" id="empDescricao" name="empDescricao" value="">
                                            </div>
                                        </div>
                                        
                                    <?php  ?>
                                </div>

                                <input type="submit" class="btn btn-pill btn-primary" value="Atualizar Descrição" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Destaques</div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="table" class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Ícone</th>
                                                <th scope="col">Título</th>
                                                <th scope="col">Texto</th>
                                                <th scope="col">Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $listDestaque = $pdo->query("SELECT * FROM destaque")->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($listDestaque as $value) { ?>
                                                <tr>
                                                    <td><i class="<?php echo $value['des_icone'] ?>"></i></td>
                                                    <td><?php echo $value['des_titulo'] ?></td>
                                                    <td><?php echo $value['des_texto'] ?></td>
                                                    <td>
                                                        <a href="destaque?id=<?php echo $value['des_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="destaque" class="btn btn-pill btn-primary">Adicionar Destaque</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Skills</div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="row">
                            <div class="col-md-12">
                                    <table id="table" class="table table-sm text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Título</th>
                                                <th class="text-center">Valor</th>
                                                <th class="text-center">Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $listSkill = $pdo->query("SELECT * FROM skills")->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($listSkill as $value) { ?>
                                                <tr>
                                                    <td><?php echo $value['sk_titulo'] ?></td>
                                                    <td><?php echo $value['sk_valor'] ?> %</td>
                                                    <td>
                                                        <a href="skill?id=<?php echo $value['sk_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="skill" class="btn btn-pill btn-primary">Adicionar Skill</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $caminho . 'footer.php'; ?>

<script>

    $(function () {
        $('.color').colorpicker({
            useAlpha: false
        });
    });

    let FormConf = "#configuracoes";
    let FormEmpresa = "#empresa";

    $(FormConf).submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "_configuracoes.php",
            data: new FormData($(FormConf)[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data == 'sucesso') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Configurações Atualizadas com Sucesso!');
                    setTimeout(function() {
                        location.reload();
                    }, 2500);
                } else {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Failure('Erro ao atualizar!');
                }
                setTimeout(function() {
                    location.reload()
                }, 2000);
            }
        });
    });

    $(FormEmpresa).submit(function() {
        event.preventDefault();
        var texto = $('#editor').summernote('code');
        $('#empDescricao').val(texto);
        debugger;
        $.ajax({
            type: "POST",
            url: "_empresa.php",
            data: new FormData($(FormEmpresa)[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data == 'atualizado') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Dados Atualizado com Sucesso!');
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
</script>