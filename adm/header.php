<?php

if (session_status() !== PHP_SESSION_ACTIVE) { //Verificar se a sessão não já está aberta.
    session_start(); /*Inicia a Seção*/
    $local = $_SESSION['caminho'];
}

if (!isset($_SESSION['usuario'])) {
    header('Location: ' . $baseUrl );
}

if ((time() - $_SESSION['tempo_login']) > 900) {
    header('Location: '. $baseUrl .'adm/system/logout?acao=expirou');
} else {
    $_SESSION['tempo_login'] = time();
}

$id = $_SESSION['id'];

$sql = $pdo->prepare("SELECT * FROM configuracoes WHERE conf_id = ?");
$sql->execute([1]);
$infoSite = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach ($infoSite as $value) {

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $value['conf_favicon_url'] ?>">
        <title>Administração</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        

        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>adm/dist/notiflix/notiflix-2.4.0.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>adm/dist/dataTable/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>adm/dist/icons/css/bootstrap-iconpicker.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>adm/dist/colorpicker/css/bootstrap-colorpicker.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>adm/dist/summernote/summernote-bs4.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>adm/dist/dropzone/dropzone.min.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>adm/dist/css/adminx.css" media="screen" />
        

    </head>

    <body>

    <input type="hidden" id="time" name="time" value="<?php echo date("F j, Y, H:i:s", strtotime('+15 minutes')) ?>" >

        <div class="adminx-container">
            <nav class="navbar navbar-expand justify-content-between fixed-top">
                <div class="navbar-brand m-0 pl-0 h1 d-none d-md-block">
                    <a href="<?php echo $baseUrl ?>adm/dashboard" style="text-decoration: none;">
                        <img src="<?php echo $baseUrl ?>assets/img/logo-jumper-cms-black.svg" class="img-fluid" style="max-height: 30px;">
                        Painel de Controle
                    </a>
                    
                </div>

                <div class="d-flex flex-1 d-block d-md-none">
                    <a href="#" class="sidebar-toggle ml-3">
                        <i data-feather="menu"></i>
                    </a>
                </div>

                <ul class="navbar-nav d-flex justify-content-end mr-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
                            <i class="far fa-user-circle" style="font-size: 25px; padding: 0 30px; color: #212529"></i>
                            
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo $baseUrl ?>adm/modulos/usuarios/?id=<?php echo $id ?>">Editar Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?php echo $baseUrl ?>adm/system/logout?acao=sair">Sair</a>
                        </div>
                    </li>
                </ul>
            </nav>

        <?php } ?>

        <?php include 'menu.php'; ?>