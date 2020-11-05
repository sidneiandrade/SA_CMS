<?php 

include './system/conexao.php'; 

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon.png">
  <title>Adminstração - Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="dist/notiflix/notiflix-2.4.0.min.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="dist/css/adminx.css" media="screen" />
  <script src="https://www.google.com/recaptcha/api.js?render=6LcCpN4ZAAAAACHEAvN2IxxRIB-Y_71DHMm8LDRC"></script>

</head>

<body>
  <div class="adminx-container d-flex justify-content-center align-items-center">
    <div class="page-login">
      <div class="text-center">
        <h1 class="display-5">Painel de Controle</h1>
      </div>
      <div class="card mb-0">
        <div class="card-body">
          <form id="loginAdm" method="post">
            <div class="form-group">
              <label for="exampleDropdownFormEmail1" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="usuarioemail" name="usuarioemail" placeholder="email@example.com" required>
            </div>
            <div class="form-group">
              <label for="exampleDropdownFormPassword1" class="form-label">Senha</label>
              <input type="password" class="form-control" id="senha" name="senha" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-sm btn-block btn-primary">Entrar</button>
          </form>
        </div>
        <div class="card-footer text-center">
          <a href="https://sadigital.com.br" class="text-decoration-none" target="_blank" style="text-decoration: none; color: #212529">
            <small>Sistema desenvolvido por</small>
            <div class="col-lg-12 text-center">
              <img src="../assets/img/logo.png" class="img-responsive" alt="SA Digital - Agência Digital" width="50%">
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
  <script src="dist/js/vendor.js"></script>
  <script src="dist/js/adminx.js"></script>
  <script src="dist/notiflix/notiflix-2.4.0.min.js"></script>
</body>

</html>

<script>

$("#loginAdm").submit(function(e) {
  debugger;
  e.preventDefault();
  grecaptcha.ready(function() {
    grecaptcha.execute('6LcCpN4ZAAAAACHEAvN2IxxRIB-Y_71DHMm8LDRC', {action: 'submit'}).then(function(token) {
      //console.log(token);
      $.ajax({
        type: "POST",
        url: "./system/recaptcha.php",
        data: "token=" + token,
        success: function(data){
          debugger;
          Notiflix.Loading.Pulse('Carregando...');
          if(data.success == true){
            debugger;
            $.ajax({
              type: "POST",
              url: "./system/login.php",
              data: $("#loginAdm").serialize(),
              success: function(data) {
                //Notiflix.Loading.Pulse('Carregando...');
                debugger;
                if (data.resultado == 'erro') {
                  Notiflix.Notify.Failure(data.msg);
                  Notiflix.Loading.Remove();
                } else if(data.resultado == 'bloqueado'){
                  Notiflix.Report.Warning(
                    'Atenção!',
                    'Seu usuário foi bloqueado ou inativado. Entre em contato com o administrador do sistema.',
                    'Ok');
                  Notiflix.Loading.Remove();
                } else {
                  window.location.href = "./dashboard";
                }
              }
            });
          } else {
            location.reload();
          }
        }
      });
    });
  });
});
  
  
</script>