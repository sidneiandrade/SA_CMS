<?php 
  include '../adm/system/conexao.php';

if (session_status() !== PHP_SESSION_ACTIVE) { //Verificar se a sessão não já está aberta.
  session_start(); /*Inicia a Seção*/
} 
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <title>404 - Página não encontrada</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>adm/dist/css/adminx.css" media="screen" />
  </head>
  <body>
    <div class="adminx-container d-flex justify-content-center align-items-center">
      <div class="page-error">
        <div class="error-code">
          404
        </div>
        <br>
        <h2>Página não encontrada!</h2>

        <?php if (!isset($_SESSION['usuario'])) { ?>
          <p class="text-muted mb-5">
            Retorne para o site.
          </p>
          <a href="<?php echo $baseUrl ?>" class="btn btn-primary"> <i data-feather="check-circle"></i> Voltar para o site.</a>
        <?php } else { ?>
          <p class="text-muted mb-5">
            Retorne para o painel de controle.
          </p>
          <a href="<?php echo $baseUrl ?>adm/dashboard" class="btn btn-primary"> <i data-feather="check-circle"></i> Voltar para o painel.</a>
        <?php } ?>

      </div>
    </div>

    <!-- If you prefer jQuery these are the required scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="<?php echo $baseUrl ?>adm/dist/js/vendor.js"></script>
    <script src="<?php echo $baseUrl ?>adm/dist/js/adminx.js"></script>

  </body>
</html>