<?php

require_once("conexao.php");
require './lib/WideImage.php';

$portId = $_POST['portId'];
$portTitulo = $_POST['portTitulo'];
$portSlug = $_POST['portSlug'];
$portEmpresa = $_POST['portEmpresa'];
$portCategoria = $_POST['portCategoria'];
$portTexto = $_POST['portTexto'];
$portStatus = $_POST['portStatus'];
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");

$dirImagens = '../../assets/img/portfolio/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/portfolio/'; //Endereço completo

switch ($Acao) {
    case "Salvar":
        try {

            $sql = $pdo->prepare("INSERT INTO PORTFOLIOS VALUES (null,?,?,?,?,?,now(),?)");
            $sql->execute([$portTitulo, $portSlug, $portEmpresa, $portCategoria, $portTexto, $portStatus]);
            $idPortfolio = $pdo->lastInsertId();

            if (isset($_FILES['portImagem'])) {

                $upload = $_FILES['portImagem'];
                $numeroImagens = count(array_filter($upload['name']));

                for ($i = 0; $i < $numeroImagens; $i++) {

                    $nameImagem = 'Portfolio-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
                    move_uploaded_file($upload['tmp_name'][$i], $dirImagens . $nameImagem); //Fazer upload do arquivo
                    $image = WideImage::load($dirImagens . $nameImagem);
                    $image = $image->crop('center', 'center', 800, 800);
                    $image->saveToFile($dirImagens . $nameImagem);
                    $pathImage = $baseDiretorio . $nameImagem;

                    $sqlImagem = $pdo->prepare("INSERT INTO PORTFOLIO_IMAGEM VALUES (null,?,?,?)");
                    $sqlImagem->execute([$idPortfolio, $nameImagem, $pathImage]);
                };
            }
            $data = ['acao' => 'salvo', 'id' => $idPortfolio];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;

    case "Atualizar":
        try {
            $sql = $pdo->prepare("UPDATE PORTFOLIOS SET PORT_NOME = ?, PORT_SLUG = ?, PORT_EMPRESA = ?, PORT_CATEGORIA = ?, PORT_TEXTO = ?, PORT_STATUS = ? WHERE PORT_ID = ?");
            $sql->execute([$portTitulo, $portSlug, $portEmpresa, $portCategoria, $portTexto, $portStatus, $portId]);

            if (isset($_FILES['portImagem'])) {

                $upload = $_FILES['portImagem'];
                $numeroImagens = count(array_filter($upload['name']));

                for ($i = 0; $i < $numeroImagens; $i++) {
                    $nameImagem = 'Portfolio-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
                    move_uploaded_file($upload['tmp_name'][$i], $dirImagens . $nameImagem); //Fazer upload do arquivo
                    $image = WideImage::load($dirImagens . $nameImagem);
                    $image = $image->crop('center', 'center', 800, 800);
                    $image->saveToFile($dirImagens . $nameImagem);
                    $pathImage = $baseDiretorio . $nameImagem;

                    $sqlImagem = $pdo->prepare("INSERT INTO PORTFOLIO_IMAGEM VALUES (null,?,?,?)");
                    $sqlImagem->execute(array($portId, $nameImagem, $pathImage));
                };
            }

            echo "atualizado";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        try {

            $Imagens = $pdo->prepare("SELECT * FROM PORTFOLIO_IMAGEM WHERE IMG_PORT_ID = ?");
            $Imagens->execute([$portId]);
            $dadosFotos = $Imagens->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dadosFotos as $fotos) {
                $idFoto = $fotos['img_id'];
                $NomeFoto = $fotos['img_nome'];

                $sqlDeletar = $pdo->prepare("DELETE FROM PORTFOLIO_IMAGEM WHERE IMG_ID = ?");
                $sqlDeletar->execute([$idFoto]);

                unlink($dirImagens . $NomeFoto);
            }

            $sql = $pdo->prepare("DELETE FROM PORTFOLIOS WHERE PORT_ID = ?");
            $sql->execute([$portId]);

            echo 'deletado';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;
}
