<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';
include $caminho . 'configuracoes/_email.php';

$empDescricao = $_POST['empDescricao'];

$dirImagens    = $caminho . '../assets/img/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/'; //Endereço completo

if (!is_dir($dirImagens)) {
    mkdir($caminho . '../assets/img/', 0755, true); // Cria uma pasta imagens
}

try{
    if (!empty($_FILES['empImagem']['name'])) {
        $NomeImagem = 'ImagemEmpresa.jpg';
        move_uploaded_file($_FILES['empImagem']['tmp_name'], $dirImagens . $NomeImagem); //Fazer upload do arquivo
        $image = WideImage::load($dirImagens . $NomeImagem);
        $image = $image->resize('540', null, 'fill', 'any');
        $image->saveToFile($dirImagens . $NomeImagem);
        $pathImage = $baseDiretorio . $NomeImagem;

        $pdo->beginTransaction();
        $sql = $pdo->prepare("UPDATE empresa SET emp_descricao = ?, emp_imagem = ? WHERE emp_id = ?");
        $sql->execute([$empDescricao, $pathImage, 1]);
        $pdo->commit();
    }

    $pdo->beginTransaction();
    $sql = $pdo->prepare("UPDATE empresa SET emp_descricao = ? WHERE emp_id = ?");
    $sql->execute([$empDescricao, 1]);
    $pdo->commit();

    echo 'atualizado';
}
catch (Exception $e) {
    echo $e->getMessage();
    EnviarEmail("Erro Modulo Empresa", $e->getMessage());
}

