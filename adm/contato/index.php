<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'header.php';

$list = $pdo->query("SELECT * FROM contatos ORDER BY cont_id DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listar Contatos</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Listar Contatos</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table id="table" class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 5%">Status</th>
                                <th style="width: 5%">Data</th>
                                <th style="width: 15%">Nome</th>
                                <th style="width: 15%">E-mail</th>
                                <th style="width: 10%">Telefone</th>
                                <th style="width: 40%">Assunto</th>
                                <th style="width: 10%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { ?>
                                <tr>
                                    <!--<td><?= $value['cont_visualizado'] == 0 ? '<span class="badge badge-success">Novo</span>' : '<span class="badge badge-secondary">Visualizado</span>' ?></td> -->
                                    <td>
                                        <?php 
                                            switch($value['cont_visualizado']){
                                                case 0:
                                                    echo '<span class="badge badge-success">Novo</span>';
                                                break;

                                                case 1:
                                                    echo '<span class="badge badge-secondary">Visualizado</span>';
                                                break;

                                                case 2: 
                                                    echo '<span class="badge badge-info">Respondido</span>';
                                                break;
                                            }
                                        ?>
                                    </td>
                                    
                                    <td><?php echo $data = date("d/m/Y", strtotime($value['cont_data'])) ?></td>
                                    <td><?php echo $value['cont_nome'] ?></td>
                                    <td><?php echo $value['cont_email'] ?></td>
                                    <td><?php echo $value['cont_telefone'] ?></td>
                                    <td><?php echo $value['cont_assunto'] ?></td>
                                    <td>
                                        <a href="mensagem.php?id=<?php echo $value['cont_id'] ?>" class="btn btn-pill btn-sm btn-outline-primary">Acessar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $caminho . 'footer.php' ?>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "pagingType": "simple",
            "order": [ 1, 'desc' ]
        });
    });
</script>