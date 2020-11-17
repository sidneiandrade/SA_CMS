<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

function EnviarEmail($assunto, $erro){

  // emails para quem será enviado o formulário
  $nome = "JUMPER - SA Digital";
  $email = "contato@sadigital.com.br";

  // É necessário indicar que o formato do e-mail é html
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: $nome <$email>';
  //$headers .= "Bcc: $EmailPadrao\r\n";

  $mensagem = "Identificado o erro: " . $erro;

  $enviaremail = mail($email, $assunto, $mensagem, $headers);
  if($enviaremail){
      echo "Sucesso";
  } else {
      echo "Erro";
  }
}
