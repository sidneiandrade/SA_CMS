<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="icon" type="image/png" sizes="16x16" href="">
  <title>Instalação do Jumper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../dist/notiflix/notiflix-2.4.0.min.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../dist/css/adminx.css" media="screen" />

</head>

<body>
  <div class="adminx-container d-flex justify-content-center align-items-center">
    <div class="page-login">
      <div class="text-center">
        <h2 class="display-5">Instalação Jumper</h2>
      </div>
      <div class="card mb-0">
        <div class="card-body">
          <form id="install" method="post">
            <div class="form-group">
              <label for="" class="form-label">SITE</label>
              <input type="text" class="form-control" id="SITE" name="SITE" required placeholder="https://meusite.com.br/">
            </div>
            <hr>
            <h3>Informações do Banco</h3>
            <div class="form-group">
              <label for="" class="form-label">HOST</label>
              <input type="text" class="form-control" id="HOST" name="HOST" required placeholder="localhost">
            </div>
            <div class="form-group">
              <label for="" class="form-label">BANCO</label>
              <input type="text" class="form-control" id="BANCO" name="BANCO" required placeholder="Nome do Banco">
            </div>
            <div class="form-group">
              <label for="" class="form-label">USUARIO</label>
              <input type="text" class="form-control" id="USUARIO" name="USUARIO" required placeholder="Usuário">
            </div>
            <div class="form-group">
              <label for="" class="form-label">SENHA</label>
              <input type="password" class="form-control" id="SENHA" name="SENHA">
            </div>
            <button type="submit" class="btn btn-sm btn-block btn-primary">INSTALAR JUMPER</button>
          </form>
        </div>
        <div class="card-footer text-center">
          <a href="https://sadigital.com.br" class="text-decoration-none" target="_blank" style="text-decoration: none; color: #212529">
            <small>Sistema desenvolvido por</small>
            <div class="col-lg-12 text-center">
              <img src="../../assets/img/logo-SADigital.png" class="img-responsive" alt="SA Digital - Agência Digital" width="25%">
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- If you prefer jQuery these are the required scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <script src="../dist/js/vendor.js"></script>
  <script src="../dist/js/adminx.js"></script>
  <script src="../dist/notiflix/notiflix-2.4.0.min.js"></script>
</body>

</html>

<script>

$("#install").submit(function(e) {
  e.preventDefault();
  Notiflix.Loading.Pulse('Carregando...');
  $.ajax({
    type: "POST",
    url: "_installJumper.php",
    data: $("#install").serialize(),
    success: function(data) {
      
      debugger;
      if (data.result == 'ok') {
        Notiflix.Loading.Remove();
        Notiflix.Report.Success(
          'Agora sim!',
          data.mensagem,
          'Ok');
        //Notiflix.Notify.Success(data.mensagem);
        setTimeout(function() {
            location.href = "../";
        }, 2500);
      } else {
        Notiflix.Loading.Remove();
        Notiflix.Notify.Failure(data.mensagem);
      }
    }
  });
});
  
  
</script>