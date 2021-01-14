<?php

//TODO Adicionar a mensagem enviada pelo cliente no corpo da resposta
//TODO Melhorar template de e-mail
//TODO Adicionar botão para deletar mensagem

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

$sql = $pdo->query("SELECT * FROM configuracoes")->fetchAll(PDO::FETCH_ASSOC);
foreach($sql as $conf){
    $NomeSite   = $conf['conf_nome'];
    $LogoSite   = $conf['conf_logo_url'];
    $EmailSite  = $conf['conf_email'];
}

$Id                 = $_POST['id'];
$NomeCliente        = $_POST['nome'];
$EmailCliente       = $_POST['email'];
$AssuntoCliente     = $_POST['assunto'];
$MensagemCliente    = $_POST['mensagem'];
$Resposta           = $_POST['resposta'];
$Acao               = $_POST['Acao'];

switch($Acao){
    case 'resposta':
        try{
    
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE contatos SET cont_resposta = ?, cont_visualizado = 2 WHERE cont_id = ?");
            $sql->execute([$Resposta, $Id]);
            $pdo->commit();   
        
            $nome = $NomeSite;
            $email = $EmailSite;
            
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'From: ' . $nome . ' <'. $email .'>';
        
            $Mensagem = "<div style='background: #e1e1e1'>
                            <div style='background: #fff; margin: 0 auto; width: 700px; padding: 20px; height: 100%; text-align: center;'>
                                <img src='.$LogoSite.' alt='.$NomeSite.' width='200' /><br>
                                <h1>Contato do Site</h1> 
                                <br>$Resposta
                            </div>
                        </div>" ;
        
            $enviaremail = mail($EmailCliente, $AssuntoCliente, $Mensagem, $headers);
            
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
    break;

    case 'deletar':
        try{

            $pdo->beginTransaction();
            $sql = $pdo->prepare("DELETE FROM contatos WHERE cont_id = ?");
            $sql->execute([$Id]);
            $pdo->commit();  

            $data = ['result' => 'ok' ,'mensagem' => 'Deletado com Sucesso!'];
            header('Content-type: application/json');
            echo json_encode($data);

        } catch( Exception $e){

            $pdo->rollBack();
            $data = ['result' => 'erro' ,'mensagem' => 'Erro'];
            header('Content-type: application/json');
            echo json_encode($data);

        }
    break;
}







