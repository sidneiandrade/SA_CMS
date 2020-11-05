<?php

include 'conexao.php';

try {
    $portImagemId = $_POST['portImagemId'];
    $portImagemNome = $_POST['portImagemNome'];

    $dirImagens = '../../assets/img/portfolio/'; //Diretório das imagens

    unlink($dirImagens . $portImagemNome);

    $sql = $pdo->prepare("DELETE FROM PORTFOLIO_IMAGEM WHERE IMG_ID = :id");
    $sql->bindParam(':id', $portImagemId);
    $sql->execute();

    echo 'sucesso';
} catch (Exception $e) {
    echo $e->getMessage();
}
