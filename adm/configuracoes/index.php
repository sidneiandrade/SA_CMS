<?php
if(!isset($_SESSION)){
    session_start();
  }
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

?>

<div class="adminx-content">
    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Configurações do Site</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Editar Configurações do Site</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-grid">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title">Ativa ou Desativar Modulos</div>
                        </div>
                        <div class="card-body collapse show">
                        <form id="configuracoes" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php 
                                        
                                        $lista = $pdo->query("SELECT * FROM modulos")->fetchAll(PDO::FETCH_ASSOC);
                                        $i = 0;
                                        foreach($lista as $value){

                                        ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input 
                                                    type="checkbox" 
                                                    class="custom-control-input" 
                                                    id="modulo_<?php echo $i ?>" 
                                                    name="modulos" 
                                                    data-id="<?php echo $value['mod_id'] ?>"
                                                    <?= ($value['mod_status'] == 1) ? 'checked="checked"' : '' ?>/>
                                                <label class="custom-control-label" for="modulo_<?php echo $i ?>">Ativar <?php echo $value['mod_titulo'] ?></label>
                                            </div>
                                        </div>

                                        <?php $i++; } ?>
                                    </div>
                                    
                                </div>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Atualizar Configurações" />
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $caminho . 'footer.php' ?>

<script>

    $("#configuracoes").submit(function() {
        event.preventDefault();
        Notiflix.Loading.Pulse('Carregando...');

        var lista = $('input[name="modulos"]').toArray().map(function (check) {
            return $(check).val();
        });

        var total = lista.length;
        debugger;
        for(var i = 0; i < total; i++){
            var modulo = $("#modulo_" + i).is(':checked');
            var id = $("#modulo_" + i).attr("data-id");
            if(modulo == true){
                var acao = "adicionar";
                $.ajax({
                    type: "POST",
                    url: "_modulos.php",
                    datatype: "json",
                    data: "ID=" + id + "&Acao=" + acao,
                    success: function(data) {},
                    error: function () {}
                });
            } else {
                var acao = "retirar";
                $.ajax({
                    type: "POST",
                    url: "_modulos.php",
                    datatype: "json",
                    data: "ID=" + id + "&Acao=" + acao,
                    success: function(data) {},
                    error: function () {}
                });
            }
        }
                

        Notiflix.Loading.Remove();
        Notiflix.Notify.Success('Configurações Atualizadas com Sucesso!');
        setTimeout(function() {
            location.reload();
        }, 2500);
    });

</script>