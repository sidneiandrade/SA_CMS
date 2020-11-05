<?php
include './system/conexao.php';
include 'header.php';

$list = $pdo->query("SELECT * FROM MEMBROS")->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Membros</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Membros</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="table" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%">Imagem</th>
                                <th style="width: 40%">Nome</th>
                                <th style="width: 20%">Cargo</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { ?>
                                <tr>
                                    <td><img src="<?php echo $value['mb_url_imagem'] ?>" alt="<?php echo $value['mb_nome'] ?>" width="100px"></td>
                                    <td><?php echo $value['mb_nome'] ?></td>
                                    <td><?php echo $value['mb_cargo'] ?></td>
                                    <td>
                                        <?php if ($value['mb_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Publicado</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="membro?id=<?php echo $value['mb_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="membro" class="btn btn-pill btn-primary">Adicionar Membro</a>
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