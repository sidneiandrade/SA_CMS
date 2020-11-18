<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';

$notId              = $_POST['notId'];
$notNomeImagem      = $_POST['notNomeImagem'];
$notTitulo          = $_POST['notTitulo'];
$notSlug            = $_POST['notSlug'];
$notTexto           = $_POST['notTexto'];
$notCategoria       = $_POST['notCategoria'];
$notStatus          = $_POST['notStatus'];
$Acao               = $_POST['Acao'];

$dirImagens = $caminho . '../assets/img/noticias/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/noticias/'; //Endereço completo

if (!is_dir($dirImagens)) {
    mkdir($caminho . '../assets/img/noticias/', 0755, true); // Cria uma pasta imagens
}

switch ($Acao){
    case "Salvar":
        try {
            $nameImagem = $notSlug . '-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
            move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $nameImagem); //Fazer upload do arquivo
            $image = WideImage::load($dirImagens . $nameImagem);
            $image = $image->resize('600', null, 'fill', 'any');
            $image = $image->crop( 'center', 'center', '100%', 300);
            $image->saveToFile($dirImagens . $nameImagem);
            $pathImagem = $baseDiretorio . $nameImagem;
    
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO noticias VALUES (null,?,?,?,?,?,?,now(),?)");
            $sql->execute([$notTitulo, $notSlug, $pathImagem, $nameImagem, $notTexto, $notCategoria, $notStatus]);
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

                unlink($dirImagens . $notNomeImagem);

                $nameImagem = $notSlug . '-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
                move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $nameImagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $nameImagem);
                $image = $image->resize('600', null, 'fill', 'any');
                $image = $image->crop( 'center', 'center', '100%', 300);
                $image->saveToFile($dirImagens . $nameImagem);
                $pathImagem = $baseDiretorio . $nameImagem;

                $pdo->beginTransaction();
                $sql = $pdo->prepare("UPDATE noticias SET not_imagem = ?, not_nome_imagem = ? WHERE not_id = ?");
                $sql->execute([$pathImagem, $nameImagem, $notId]);
                $pdo->commit();
            }

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE noticias SET not_titulo = ?, not_slug = ?, not_texto = ?, not_categoria = ?, not_status = ? WHERE not_id = ?");
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

            $sql = $pdo->prepare("DELETE FROM noticias WHERE not_id = ?");
            $sql->execute([$notId]);
            echo 'deletado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    break;
}
