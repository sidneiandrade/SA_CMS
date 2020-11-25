<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

function EnviarEmail($assunto, $erro){

  $nome = "JUMPER - SA Digital";
  $email = "contato@sadigital.com.br";
  
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=uft-8' . "\r\n";
  $headers .= 'From: ' . $nome . ' <'. $email .'>';

  $mensagem = "Identificado o erro: <br>" . $erro[0] . "<br> Na Linha: " . $erro[1];

  $enviaremail = mail($email, $assunto, $mensagem, $headers);
  if($enviaremail){
      echo "Sucesso";
  } else {
      echo "Erro";
  }
}
