<?php
include 'conexao.php';
require './lib/WideImage.php';

$notId = $_POST['notId'];
$notNomeImagem = $_POST['notNomeImagem'];
$notTitulo = $_POST['notTitulo'];
$notSlug = $_POST['notSlug'];
$notTexto = $_POST['notTexto'];
$notCategoria = $_POST['notCategoria'];
$notStatus = $_POST['notStatus'];
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");

$dirImagens = '../../assets/img/noticias/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/noticias/'; //Endereço completo


switch ($Acao){
    case "Salvar":
        try {
            $nameImagem = $notSlug . '-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
            move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $nameImagem); //Fazer upload do arquivo
            $image = WideImage::load($dirImagens . $nameImagem);
            $image = $image->resize('600', '300', 'fill', 'any');
            $image->saveToFile($dirImagens . $nameImagem);
            $pathImage = $baseDiretorio . $nameImagem;
    
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO NOTICIAS VALUES (null,?,?,?,?,?,?,now(),?)");
            $sql->execute([$notTitulo, $notSlug, $pathImage, $nameImagem, $notTexto, $notCategoria, $notStatus]);
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
                move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $notNomeImagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $notNomeImagem);
                $image = $image->resize('600', '300', 'fill', 'any');
                $image->saveToFile($dirImagens . $notNomeImagem);
            }

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE NOTICIAS SET NOT_TITULO = ?, NOT_SLUG = ?, NOT_TEXTO = ?, NOT_CATEGORIA = ?, NOT_STATUS = ? WHERE NOT_ID = ?");
            $sql->execute([$notTitulo, $notSlug, $notTexto, $notCategoria, $notStatus, $notId]);
            $pdo->commit();

            echo 'atualizado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    break;

    case "Deletar":
        try{
            unlink($dirImagens . $notNomeImagem);

            $sql = $pdo->prepare("DELETE FROM NOTICIAS WHERE NOT_ID = ?");
            $sql->execute([$notId]);
            echo 'deletado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    break;
}
