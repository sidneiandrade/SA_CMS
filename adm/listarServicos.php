<?php
include './system/conexao.php';
include 'header.php';

$listServicos = $pdo->query("SELECT * FROM servicos ORDER BY serv_id DESC")->fetchAll();

?>


<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Serviços</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Serviços</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="tableUser" class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Ícone</th>
                                <th scope="col">Título</th>
                                <th scope="col">Texto</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listServicos as $value) { ?>
                                <tr>
                                    <td><i class="<?php echo $value['serv_icone'] ?>"></i></td>
                                    <td><?php echo $value['serv_titulo'] ?></td>
                                    <td><?php echo $value['serv_texto'] ?></td>
                                    <td>
                                        <a href="servico?id=<?php echo $value['serv_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="servico" class="btn btn-pill btn-primary">Adicionar Serviço</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#tableUser').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "pagingType": "simple"
        });
    });
</script>