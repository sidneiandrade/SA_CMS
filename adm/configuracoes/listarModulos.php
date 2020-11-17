<?php
define('caminho', $_SERVER['DOCUMENT_ROOT'] . '/system/adm/');

include caminho . 'system/conexao.php';
include caminho . 'header.php';

$list = $pdo->query("SELECT * FROM modulos ORDER BY mod_ordem DESC")->fetchAll(PDO::FETCH_ASSOC);

?>


<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Modulos</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Modulos</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="table" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%">Ordem</th>
                                <th style="width: 10%">Icone</th>
                                <th style="width: 50%">Títulos</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { ?>
                                <tr>
                                    <td><?php echo $value['mod_ordem'] ?></td>
                                    <td><i data-feather="<?php echo $value['mod_icone'] ?>"></i></td>
                                    <td><?php echo $value['mod_titulo'] ?></td>
                                    <td>
                                        <?php if ($value['mod_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Ativo</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="modulos?id=<?php echo $value['mod_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="modulos" class="btn btn-pill btn-primary">Adicionar Modulo</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include caminho . 'footer.php' ?>

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