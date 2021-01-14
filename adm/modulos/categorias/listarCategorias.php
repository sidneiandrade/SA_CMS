<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$listCategorias = $pdo->query("SELECT * FROM categorias ORDER BY cat_id DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Categorias</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Categorias</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="tableCategorias" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 25%">Categoria</th>
                                <th style="width: 25%">Origem</th>
                                <th style="width: 20%">Status</th>
                                <th style="width: 20%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listCategorias as $value) { ?>
                                <tr>
                                    <td><?php echo $value['cat_id'] ?></td>
                                    <td><?php echo $value['cat_nome'] ?></td>
                                    <td>
                                    <?php
                                        switch($value['cat_origem']){
                                            case 'p':
                                                echo '<span class="badge badge-pill badge-warning">Portfólio</span>';
                                            break;
                                            
                                            case 'n':
                                                echo '<span class="badge badge-pill badge-info">Notícias</span>'; 
                                            break;

                                            case 'c':
                                                echo '<span class="badge badge-pill badge-secondary">Cardápio</span>'; 
                                            break;
                                        }
                                    ?>
                                    </td>
                                    <td><?php if ($value['cat_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Ativo</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="./?id=<?php echo $value['cat_id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="./" class="btn btn-primary">Adicionar Categoria</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $caminho . 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#tableCategorias').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "pagingType": "simple"
        });
    });
</script>