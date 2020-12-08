<?php

//TODO: Verificar o slug da notícia antes de salvar.

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';
include $caminho . 'configuracoes/_email.php';

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
    mkdir($dirImagens, 0755, true); // Cria uma pasta imagens
}

switch ($Acao){
    case "Salvar":
        try {

            //verifica se já existe uma notícia com o mesmo slug
            $sql = $pdo->prepare("SELECT not_slug FROM noticias WHERE not_slug = ? and not_status = ?");
            $sql->execute([$notSlug, 1]);
            $result = $sql->fetchAll();
            $quant = count($result);

            if($quant > 0){

                $data = ['error' => 'erro', 'mensagem' => 'Já existe um título com este nome'];
                header('Content-type: application/json');
                echo json_encode($data);

            } else {

                $nameImagem = $notSlug . '-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
                move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $nameImagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $nameImagem);
                $image = $image->resize('600', null, 'fill', 'any');
                $image = $image->crop( 'center', 'center', '100%', 300);
                $image->saveToFile($dirImagens . $nameImagem, 60);
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
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Notícias", [$e->getMessage(), $e->getLine()]);
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
                $image->saveToFile($dirImagens . $nameImagem, 60);
                $pathImagem = $baseDiretorio . $nameImagem;

                $pdo->beginTransaction();
                $sql = $pdo->prepare("UPDATE noticias SET not_imagem = ?, not_nome_imagem = ? WHERE not_id = ?");
                $sql->execute([$pathImagem, $nameImagem, $notId]);
                $pdo->commit();
            }

            //verifica se já existe uma notícia com o mesmo slug
            $sql = $pdo->prepare("SELECT * FROM noticias WHERE not_slug = ? and not_status = ?");
            $sql->execute([$notSlug, 1]);
            $result = $sql->fetchAll();
            foreach($result as $verify){
                $ID = $verify['not_id'];
            }
            $quant = count($result);

            if($quant == 1 && $ID == $notId){
                $pdo->beginTransaction();
                $sql = $pdo->prepare("UPDATE noticias SET not_titulo = ?, not_slug = ?, not_texto = ?, not_categoria = ?, not_status = ? WHERE not_id = ?");
                $sql->execute([$notTitulo, $notSlug, $notTexto, $notCategoria, $notStatus, $notId]);
                $pdo->commit();

                echo 'atualizado';
            } else if ($quant == 0){
                $pdo->beginTransaction();
                $sql = $pdo->prepare("UPDATE noticias SET not_titulo = ?, not_slug = ?, not_texto = ?, not_categoria = ?, not_status = ? WHERE not_id = ?");
                $sql->execute([$notTitulo, $notSlug, $notTexto, $notCategoria, $notStatus, $notId]);
                $pdo->commit();

                echo 'atualizado';
            } else {
                $data = ['error' => 'erro', 'mensagem' => 'Já existe um título com este nome'];
                header('Content-type: application/json');
                echo json_encode($data);
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Notícias", [$e->getMessage(), $e->getLine()]);
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
            EnviarEmail("Erro Modulo Notícias", [$e->getMessage(), $e->getLine()]);
        }
    break;
}

