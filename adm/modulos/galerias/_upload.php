<?php

// Criar banco para salvar o caminho das imagens

if(!isset($_SESSION)){
  session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';

$uploaddir = '../../uploads/';
    
try {
  $nameImagem = 'galeria-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
  move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploaddir . $nameImagem); //Fazer upload do arquivo
  //$image = WideImage::load($uploaddir . $nameImagem);
  //$image = $image->resize('1500', null, 'fill', 'any');
  //$image->saveToFile($uploaddir . $nameImagem);

} catch(Exception $e){
    echo 'erro';
}