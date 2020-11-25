<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';
include $caminho . 'configuracoes/_email.php';

$Id             = $_POST['Id'];
$sdNomeImagem   = $_POST['sdNomeImagem'];
$sdTitulo       = $_POST['sdTitulo'];
$sdTexto        = $_POST['sdTexto'];
$sdBotao        = $_POST['sdBotao'];
$sdStatus       = $_POST['sdStatus'];
$Acao           = $_POST['Acao'];

$dirImagens = $caminho . '../assets/img/slide/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/slide/'; //Endereço completo

if (!is_dir($dirImagens)) {
    mkdir($dirImagens, 0755, true); // Cria uma pasta imagens
}

switch ($Acao){
    case "Salvar":
        try {
            $nameImagem = 'Slide-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
            move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $nameImagem); //Fazer upload do arquivo
            $image = WideImage::load($dirImagens . $nameImagem);
            $image = $image->resize('1500', null, 'fill', 'any');
            $image->saveToFile($dirImagens . $nameImagem);
            $pathImage = $baseDiretorio . $nameImagem;
    
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO slides VALUES (null,?,?,?,?,?,?)");
            $sql->execute([$sdTitulo, $nameImagem, $pathImage, $sdTexto, $sdBotao, $sdStatus]);
            $id = $pdo->lastInsertId();
            $pdo->commit();
    
            $data = ['acao' => 'salvo', 'id' => $id];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Slides", [$e->getMessage(), $e->getLine()]);
        }
    break;

    case "Atualizar":
        try{
            if (!empty($_FILES['arquivoImagem']['name'])) {

                unlink($dirImagens . $sdNomeImagem); // deletar a imagem na pasta

                $nameImagem = 'Slide-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
                move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $nameImagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $nameImagem);
                $image = $image->resize('1500', null, 'fill', 'any');
                $image->saveToFile($dirImagens . $nameImagem);
                $pathImagem = $baseDiretorio . $nameImagem;

                $pdo->beginTransaction();
                $sql = $pdo->prepare("UPDATE slides SET sd_imagem = ?, sd_url_imagem = ? WHERE sd_id = ?");
                $sql->execute([$nameImagem, $pathImagem, $Id]);
                $pdo->commit();
            }

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE slides SET sd_titulo = ?, sd_texto = ?, sd_url_botao = ?, sd_status = ? WHERE sd_id = ?");
            $sql->execute([$sdTitulo, $sdTexto, $sdBotao, $sdStatus, $Id]);
            $pdo->commit();

            echo 'atualizado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Slides", [$e->getMessage(), $e->getLine()]);
        }
    break;

    case "Deletar":
        try{
            unlink($dirImagens . $sdNomeImagem);

            $sql = $pdo->prepare("DELETE FROM slides WHERE sd_id = ?");
            $sql->execute([$Id]);
            echo 'deletado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Slides", [$e->getMessage(), $e->getLine()]);
        }
    break;
}

