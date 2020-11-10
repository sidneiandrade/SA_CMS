<?php
include './system/conexao.php';
include 'header.php';

$listDepoimentos = $pdo->query("SELECT * FROM depoimentos")->fetchAll(PDO::FETCH_ASSOC);

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
                                <th scope="col">Nome</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Texto</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listDepoimentos as $value) { ?>
                                <tr>
                                    <td><?php echo $value['dep_nome'] ?></td>
                                    <td><?php echo $value['dep_empresa'] ?></td>
                                    <td><?php echo $value['dep_texto'] ?></td>
                                    <td>
                                        <a href="depoimento?id=<?php echo $value['dep_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="depoimento" class="btn btn-pill btn-primary">Adicionar Depoimento</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>

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