<?php
include './system/conexao.php';
include 'header.php';

$list = $pdo->query("SELECT * FROM PERGUNTAS")->fetchAll();

?>


<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Perguntas</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Perguntas</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="table" class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Pergunta</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { ?>
                                <tr>
                                    <td><?php echo $value['pg_pergunta'] ?></td>
                                    <td>
                                        <?php if ($value['pg_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Publicado</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="pergunta?id=<?php echo $value['pg_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="pergunta" class="btn btn-pill btn-primary">Adicionar Pergunta</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>

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