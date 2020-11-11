<?php
include './system/conexao.php';
include 'header.php';

$listPaginas = $pdo->query("SELECT * FROM paginas ORDER BY pag_id DESC")->fetchAll(PDO::FETCH_ASSOC);

?>


<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Páginas</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Páginas</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="tablePaginas" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%">Imagem</th>
                                <th style="width: 60%">Titulo</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listPaginas as $value) { ?>
                                <tr>
                                    <td><img src="<?php echo $value['pag_imagem'] ?>" alt="<?php echo $value['pag_titulo'] ?>" width="100px"></td>
                                    <td><?php echo $value['pag_titulo'] ?></td>
                                    <td>
                                        <?php if ($value['pag_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Publicado</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="pagina?id=<?php echo $value['pag_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="pagina" class="btn btn-pill btn-primary">Adicionar Página</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#tablePaginas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "pagingType": "simple"
        });
    });
</script>