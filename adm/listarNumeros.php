<?php
include './system/conexao.php';
include 'header.php';

$listNumeros = $pdo->query("SELECT * FROM NUMEROS")->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Nossos Números</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Nossos Números</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="tableNumeros" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 50%">Titulo</th>
                                <th style="width: 30%">Números</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listNumeros as $value) { ?>
                                <tr>
                                    <td><?php echo $value['num_titulo'] ?></td>
                                    <td><?php echo $value['num_numero'] ?></td>
                                    <td>
                                        <?php if ($value['num_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Publicado</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="numero?id=<?php echo $value['num_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="numero" class="btn btn-pill btn-primary">Adicionar Números</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#tableNumeros').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "pagingType": "simple"
        });
    });
</script>