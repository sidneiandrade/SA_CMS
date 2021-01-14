<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$listDepoimentos = $pdo->query("SELECT * FROM depoimentos ORDER BY dep_id DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Depoimentos</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Depoimentos</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="tableDepoimento" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%">Nome</th>
                                <th style="width: 10%">Empresa</th>
                                <th style="width: 70%">Mensagem</th>
                                <th style="width: 10%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listDepoimentos as $value) { ?>
                                <tr>
                                    <td><?php echo $value['dep_nome'] ?></td>
                                    <td><?php echo $value['dep_empresa'] ?></td>
                                    <td><?php echo $value['dep_texto'] ?></td>
                                    <td>
                                        <a href="./?id=<?php echo $value['dep_id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="./" class="btn btn-primary">Adicionar Depoimento</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include $caminho . 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#tableDepoimento').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "pagingType": "simple"
        });
    });
</script>