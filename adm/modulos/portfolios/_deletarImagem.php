<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

try {
    $portImagemId = $_POST['portImagemId'];
    $portImagemNome = $_POST['portImagemNome'];

    $dirImagens = $caminho . '../assets/img/portfolio/'; //Diretório das imagens

    unlink($dirImagens . $portImagemNome);

    $sql = $pdo->prepare("DELETE FROM portfolio_imagem WHERE img_id = :id");
    $sql->bindParam(':id', $portImagemId);
    $sql->execute();

    echo 'sucesso';
} catch (Exception $e) {
    echo $e->getMessage();
}
