<?php

include 'conexao.php';
require './lib/WideImage.php';

// Nas versões do PHP que antecedem a versão 4.1.0, é preciso usar o $HTTP_POST_FILES em vez do $_FILES.
  $uploaddir = '../uploads/';
  //$baseDiretorio = $uploaddir . basename($_FILES['fileToUpload']['name']); //Endereço completo
     
  try {
    $nameImagem = 'teste-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploaddir . $nameImagem); //Fazer upload do arquivo
    //$image = WideImage::load($uploaddir . $nameImagem);
    //$image = $image->resize('1500', null, 'fill', 'any');
    //$image->saveToFile($uploaddir . $nameImagem);

  } catch(Exception $e){
      echo 'erro';
  }