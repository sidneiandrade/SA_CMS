<?php
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

    $enviaremail = mail($EmailCliente, $Assunto, $Resposta, $headers);
    
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



