<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$list = $pdo->query("SELECT * FROM slides ORDER BY sd_id DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Slides</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-6">
                    <div class="pb-3">
                        <h1>Listar Slides</h1> 
                        <!-- <a href="./" class="btn btn-pill btn-primary btn-sm">Adicionar Slide</a> -->
                    </div>
                </div>
                <!-- <div class="col-lg-6 text-right">
                    <a href="./" class="btn btn-pill btn-primary">Adicionar Slide</a>
                </div> -->
            </div>
            

            <div class="row">
                <div class="col-md-12">
                    <table id="table" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%">Imagem</th>
                                <th style="width: 60%">Titulo</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { ?>
                                <tr>
                                    <td><img src="<?php echo $value['sd_url_imagem'] ?>" alt="<?php echo $value['sd_titulo'] ?>" width="100px"></td>
                                    <td><?php echo $value['sd_titulo'] ?></td>
                                    <td>
                                        <?php if ($value['sd_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Publicado</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="./?id=<?php echo $value['sd_id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="./" class="btn btn-primary">Adicionar Slide</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include $caminho . 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "pagingType": "simple"
        });
    });
</script>