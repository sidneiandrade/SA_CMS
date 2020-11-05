<?php
include 'conexao.php';
require './lib/WideImage.php';

$empDescricao = $_POST['empDescricao'];

$dirImagens = '../../assets/img/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/'; //Endereço completo

try{
    if (!empty($_FILES['empImagem']['name'])) {
        $NomeImagem = 'ImagemEmpresa.jpg';
        move_uploaded_file($_FILES['empImagem']['tmp_name'], $dirImagens . $NomeImagem); //Fazer upload do arquivo
        $image = WideImage::load($dirImagens . $NomeImagem);
        $image = $image->resize('540', '370', 'fill', 'any');
        $image->saveToFile($dirImagens . $NomeImagem);
        $pathImage = $baseDiretorio . $NomeImagem;

        $pdo->beginTransaction();
        $sql = $pdo->prepare("UPDATE EMPRESA SET EMP_DESCRICAO = ?, EMP_IMAGEM = ? WHERE EMP_ID = ?");
        $sql->execute([$empDescricao, $pathImage, 1]);
        $pdo->commit();
    }

    $pdo->beginTransaction();
    $sql = $pdo->prepare("UPDATE EMPRESA SET EMP_DESCRICAO = ? WHERE EMP_ID = ?");
    $sql->execute([$empDescricao, 1]);
    $pdo->commit();

    echo 'atualizado';
}
catch (Exception $e) {
    echo $e->getMessage();
}

