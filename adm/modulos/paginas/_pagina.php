<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';

$pagId              = $_POST['pagId'];
$pagNomeImagem      = $_POST['pagNomeImagem'];
$pagTitulo          = $_POST['pagTitulo'];
$pagSlug            = $_POST['pagSlug'];
$pagTexto           = $_POST['pagTexto'];
$pagStatus          = $_POST['pagStatus'];
$Acao               = $_POST['Acao'];

$dirImagens = $caminho . '../assets/img/paginas/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/paginas/'; //Endereço completo

if (!is_dir($dirImagens)) {
    mkdir($caminho . '../assets/img/paginas/', 0755, true); // Cria uma pasta imagens
}

switch ($Acao) {
    case "Salvar":
        try {
            $nameImagem = $pagSlug . '-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
            move_uploaded_file($_FILES['pagImagem']['tmp_name'], $dirImagens . $nameImagem); //Fazer upload do arquivo
            $image = WideImage::load($dirImagens . $nameImagem);
            $image = $image->resize('600', '300', 'fill', 'any');
            //$image = $image->crop('center', 'center', 800, 800);
            $image->saveToFile($dirImagens . $nameImagem);
            $pathImage = $baseDiretorio . $nameImagem;

            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO paginas VALUES (null,?,?,?,?,?,now(),?)");
            $sql->execute([$pagTitulo, $pagSlug, $pathImage, $nameImagem, $pagTexto, $pagStatus]);
            $IDPagina = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $IDPagina];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Atualizar":
        try {

            if (!empty($_FILES['pagImagem']['name'])) {
                $pagNomeImagem = $_POST['pagNomeImagem'];
                move_uploaded_file($_FILES['pagImagem']['tmp_name'], $dirImagens . $pagNomeImagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $pagNomeImagem);
                $image = $image->resize('600', '300', 'fill', 'any');
                $image->saveToFile($dirImagens . $pagNomeImagem);
            }

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE paginas SET pag_titulo = ?, pag_slug = ?, pag_texto = ?, pag_status = ? WHERE pag_id = ?");
            $sql->execute([$pagTitulo, $pagSlug, $pagTexto, $pagStatus, $pagId]);
            $pdo->commit();

            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        try {
            unlink($dirImagens . $pagNomeImagem);

            $sql = $pdo->prepare("DELETE FROM paginas WHERE pag_id = ?");
            $sql->execute([$pagId]);
            echo 'deletado';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;
}
