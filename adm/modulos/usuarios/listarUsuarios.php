<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$listUsuario = $pdo->query("SELECT * FROM usuario ORDER BY usu_id DESC")->fetchAll();

?>


<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Usuários</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Usuários</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="tableUser" class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nível</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listUsuario as $value) { ?>
                                <tr>
                                    <td><?php echo $value['usu_nome'] ?></td>
                                    <td><?php echo $value['usu_email'] ?></td>
                                    <td><?= $value['usu_nivel'] == 1 ? 'Administrador' : 'Usuário'; ?></td>
                                    <td>
                                        <?php if ($value['usu_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Ativo</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="./?id=<?php echo $value['usu_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="./" class="btn btn-pill btn-primary">Adicionar Usuário</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include $caminho . 'footer.php' ?>

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