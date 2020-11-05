<?php
include 'conexao.php';
require './lib/WideImage.php';

$Id = $_POST['Id'];
$sdNomeImagem = $_POST['sdNomeImagem'];
$sdTitulo = $_POST['sdTitulo'];
$sdTexto = $_POST['sdTexto'];
$sdBotao = $_POST['sdBotao'];
$sdStatus = $_POST['sdStatus'];
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");

$dirImagens = '../../assets/img/slide/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/slide/'; //Endereço completo


switch ($Acao){
    case "Salvar":
        try {
            $nameImagem = 'Slide-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
            move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $nameImagem); //Fazer upload do arquivo
            $image = WideImage::load($dirImagens . $nameImagem);
            $image = $image->resize('1500', '600', 'fill', 'any');
            $image->saveToFile($dirImagens . $nameImagem);
            $pathImage = $baseDiretorio . $nameImagem;
    
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO SLIDES VALUES (null,?,?,?,?,?,?)");
            $sql->execute([$sdTitulo, $nameImagem, $pathImage, $sdTexto, $sdBotao, $sdStatus]);
            $id = $pdo->lastInsertId();
            $pdo->commit();
    
            $data = ['acao' => 'salvo', 'id' => $id];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    break;

    case "Atualizar":
        try{
            if (!empty($_FILES['arquivoImagem']['name'])) {
                move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $sdNomeImagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $sdNomeImagem);
                $image = $image->resize('1500', '600', 'fill', 'any');
                $image->saveToFile($dirImagens . $sdNomeImagem);
            }

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE SLIDES SET SD_TITULO = ?, SD_TEXTO = ?, SD_URL_BOTAO = ?, SD_STATUS = ? WHERE SD_ID = ?");
            $sql->execute([$sdTitulo, $sdTexto, $sdBotao, $sdStatus, $Id]);
            $pdo->commit();

            echo 'atualizado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    break;

    case "Deletar":
        try{
            unlink($dirImagens . $sdNomeImagem);

            $sql = $pdo->prepare("DELETE FROM SLIDE WHERE SD_ID = ?");
            $sql->execute([$Id]);
            echo 'deletado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    break;
}
