<?php 

//define('caminho', $_SERVER['DOCUMENT_ROOT'] . '/system/adm/');
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require caminho . 'system/PHPMailer/src/Exception.php';
// require caminho . 'system/PHPMailer/src/PHPMailer.php';
// require caminho . 'system/PHPMailer/src/SMTP.php';

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

    // //Create a new PHPMailer instance
    // $mail = new PHPMailer;
    // // Set PHPMailer to use the sendmail transport
    // $mail->isSendmail();
    // $mail->CharSet = 'UTF-8';
    // //Set who the message is to be sent from
    // $mail->setFrom($Email, $Nome);
    // //Set who the message is to be sent to
    // $mail->addAddress($Email, $Nome);
    // //Set the subject line
    // $mail->Subject = $assunto;
    // //Read an HTML message body from an external file, convert referenced images to embedded,
    // //convert HTML into a basic plain-text alternative body
    // $mail->msgHTML($body);
    // $mail->Body = $erro;
    // //send the message, check for errors
    //     if (!$mail->send()) {
    //         echo 'Mailer Error: '. $mail->ErrorInfo;
    //     } else {
    //         echo 'sucesso';
    //     }
    }

