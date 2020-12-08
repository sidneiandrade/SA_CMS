<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$ID = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM contatos WHERE cont_id = ?");
$sql->execute([$ID]);
$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach ($dados as $value) {
    $Nome = $value['cont_nome'];
    $Email = $value['cont_email'];
    $Telefone = $value['cont_telefone'];
    $Assunto = $value['cont_assunto'];
    $Mensagem = $value['cont_mensagem'];
    $Resposta = $value['cont_resposta'];
    $Status = $value['cont_visualizado'];
}
if($Status == 0){
    $visualizado = $pdo->query("UPDATE contatos SET cont_visualizado = 1 WHERE cont_id = $ID");
}


?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mensagem</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Mensagem</h1>
            </div>
            <form id="formResposta" method="post">
                <div class="row">
                
                    <div class="col-lg-6">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Informações do Contato</div>
                            </div>
                            <div class="card-body collapse show" id="cardCadastrar">
                                <input type="hidden" id="id"        name="id"       value="<?php echo $ID ?>">
                                <input type="hidden" id="nome"      name="nome"     value="<?php echo $Nome ?>">
                                <input type="hidden" id="email"     name="email"    value="<?php echo $Email ?>">
                                <input type="hidden" id="assunto"   name="assunto"  value="<?php echo $Assunto ?>">
                                <input type="hidden" id="mensagem"  name="mensagem" value="<?php echo $Mensagem ?>">
                                
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="nome">Nome</label>
                                            <input type="text" class="form-control" value="<?php echo $Nome ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="email">E-mail</label>
                                            <input type="text" class="form-control"  value="<?php echo $Email ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="telefone">Telefone</label>
                                            <input type="text" class="form-control" value="<?php echo $Telefone ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="assunto">Assunto</label>
                                            <input type="text" class="form-control" value="<?php echo $Assunto ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="mensagem">Mensagem</label>
                                            <textarea class="form-control" rows="8" disabled><?php echo $Mensagem ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-grid">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Resposta</div>
                            </div>
                            <div class="card-body collapse show" id="cardResposta">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="6" id="resposta" name="resposta" required><?php echo $Resposta ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-pill btn-primary">Enviar Resposta</button>
                                        <a href="index" class="btn btn-warning btn-pill">Voltar</a>
                                    </div>
                                </div>
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

    let Form = "#formResposta";

    $(Form).submit(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "_resposta.php",
            data: new FormData($(Form)[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.result == 'ok') {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success(data.mensagem);
                } else {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Failure(data.mensagem);
                }
            }
        });
    });
</script>
