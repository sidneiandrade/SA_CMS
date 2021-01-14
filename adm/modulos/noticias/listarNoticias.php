<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$listNoticias = $pdo->query("SELECT * FROM noticias ORDER BY not_id DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Notícias</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Notícias</h1>
                <!-- <a href="./" class="btn btn-pill btn-primary btn-sm">Adicionar Notícia</a> -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="tableNoticias" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%">Imagem</th>
                                <th style="width: 40%">Titulo</th>
                                <th style="width: 20%">Categoria</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listNoticias as $value) { ?>
                                <tr>
                                    <td><img src="<?php echo $value['not_imagem'] ?>" alt="<?php echo $value['not_titulo'] ?>" width="100px"></td>
                                    <td><?php echo $value['not_titulo'] ?></td>
                                    <td>
                                    <?php
                                        $categoria = $value['not_categoria'];
                                        $sqlCat = $pdo->prepare("SELECT * FROM categorias WHERE cat_origem = 'N' AND cat_id = $categoria");
                                        $sqlCat->execute();
                                        $result = $sqlCat->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $key => $vCategoria) {
                                            echo $vCategoria['cat_nome'];
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($value['not_status'] == 1) {
                                            echo '<span class="badge badge-pill badge-success">Publicado</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-danger">Inativo</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="./?id=<?php echo $value['not_id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="./" class="btn btn-primary">Adicionar Notícia</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include $caminho . 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#tableNoticias').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "pagingType": "simple"
        });
    });
</script>