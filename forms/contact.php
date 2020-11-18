<?php

  include '../adm/system/conexao.php';

  $sql = $pdo->query("SELECT * FROM configuracoes");
  $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
  $emailContato = $dados[0]['conf_email'];

  // emails para quem será enviado o formulário
  $emailSystem = $emailContato;
  $nome = $_POST['name'];
  $email = $_POST['email'];
  $assunto = $_POST['subject'];
  $messagem = $_POST['message'];

  // É necessário indicar que o formato do e-mail é html
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: $nome <$email>';
  //$headers .= "Bcc: $EmailPadrao\r\n";

  $enviaremail = mail($emailSystem, $assunto, $messagem, $headers);
  if($enviaremail){
      echo "Sucesso";
  } else {
      echo "Erro";
  }

?>
