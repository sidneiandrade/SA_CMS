<?php

//
//TODO
//
// []colocar as informações do site como nome, email e imagem
// []adicionar a mensagem enviada pelo cliente no corpo da resposta
// []melhorar template de e-mail
//

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

$Id             = $_POST['id'];
$NomeCliente    = $_POST['nome'];
$EmailCliente   = $_POST['email'];
$Assunto        = $_POST['assunto'];
$Resposta       = $_POST['resposta'];

try{
    
    $pdo->beginTransaction();
    $sql = $pdo->prepare("UPDATE contatos SET cont_resposta = ? WHERE cont_id = ?");
    $sql->execute([$Resposta, $Id]);
    $pdo->commit();   

    $nome = "JUMPER - SA Digital";
    $email = "contato@sadigital.com.br";
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: ' . $nome . ' <'. $email .'>';

    $Mensagem = "<div style='background: #e1e1e1'>
                    <div style='background: #fff; margin: 0 auto; width: 700px; padding: 20px; height: 100%; text-align: center;'>
                        <img src='https://sadigital.com.br/cms/assets/img/logo-987000012.png' alt='Jumper' width='200' /><br>
                        <h1>Contato do Site</h1> 
                        <br>$Resposta
                    </div>
                </div>";

    $enviaremail = mail($EmailCliente, $Assunto, $Mensagem, $headers);
    
    if($enviaremail){

    $data = ['result' => 'ok' ,'mensagem' => 'Enviado com Sucesso!'];
    header('Content-type: application/json');
    echo json_encode($data);
  
    } else {

        $data = ['result' => 'erro' ,'mensagem' => 'Erro ao enviar!'];
        header('Content-type: application/json');
        echo json_encode($data);
    }

} catch( Exception $e){
    $pdo->rollBack();
    $data = ['result' => 'erro' ,'mensagem' => 'Erro'];
    header('Content-type: application/json');
    echo json_encode($data);
}




