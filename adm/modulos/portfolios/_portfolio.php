<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';
include $caminho . 'configuracoes/_email.php';

$portId         = $_POST['portId'];
$Acao           = $_POST['Acao'];

$dirImagens     = $caminho . '../assets/img/portfolio/'; //Diretório das imagens
$baseDiretorio  = $baseUrl . 'assets/img/portfolio/'; //Endereço completo

if (!is_dir($dirImagens)) {
    mkdir($caminho . '../assets/img/portfolio/', 0755, true); // Cria uma pasta imagens
}

switch ($Acao) {
    case "Salvar":
        try {

            $portTitulo     = $_POST['portTitulo'];
            $portSlug       = $_POST['portSlug'];
            $portEmpresa    = $_POST['portEmpresa'];
            $portCategoria  = $_POST['portCategoria'];
            $portTexto      = $_POST['portTexto'];
            $portUrl        = $_POST['portUrl'];
            $portStatus     = $_POST['portStatus'];

            $sql = $pdo->prepare("INSERT INTO portfolios VALUES (null,?,?,?,?,?,?,now(),?)");
            $sql->execute([$portTitulo, $portSlug, $portEmpresa, $portCategoria, $portTexto, $portUrl, $portStatus]);
            $idPortfolio = $pdo->lastInsertId();

            if (isset($_FILES['portImagem'])) {

                $upload = $_FILES['portImagem'];
                $numeroImagens = count(array_filter($upload['name']));

                for ($i = 0; $i < $numeroImagens; $i++) {

                    $nameImagem = $portSlug . rand() . '.jpg'; //Definindo um novo nome para o arquivo
                    move_uploaded_file($upload['tmp_name'][$i], $dirImagens . $nameImagem); //Fazer upload do arquivo
                    $image = WideImage::load($dirImagens . $nameImagem);
                    $image = $image->resize(null, '400', 'inside', 'any');
                    $image = $image->crop('center', 'center', '100%', 400);
                    $image->saveToFile($dirImagens . $nameImagem);
                    $pathImage = $baseDiretorio . $nameImagem;

                    $sqlImagem = $pdo->prepare("INSERT INTO portfolio_imagem VALUES (null,?,?,?)");
                    $sqlImagem->execute([$idPortfolio, $nameImagem, $pathImage]);
                };
            }
            $data = ['acao' => 'salvo', 'id' => $idPortfolio];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Portfólio - " + $Acao, $e->getMessage());
        }
        break;

    case "Atualizar":
        try {

            $portTitulo     = $_POST['portTitulo'];
            $portSlug       = $_POST['portSlug'];
            $portEmpresa    = $_POST['portEmpresa'];
            $portCategoria  = $_POST['portCategoria'];
            $portTexto      = $_POST['portTexto'];
            $portUrl        = $_POST['portUrl'];
            $portStatus     = $_POST['portStatus'];

            $sql = $pdo->prepare("UPDATE portfolios SET port_nome = ?, port_slug = ?, port_empresa = ?, port_categoria = ?, port_texto = ?, port_url = ?, port_status = ? WHERE port_id = ?");
            $sql->execute([$portTitulo, $portSlug, $portEmpresa, $portCategoria, $portTexto, $portUrl, $portStatus, $portId]);

            if (isset($_FILES['portImagem'])) {

                $upload = $_FILES['portImagem'];
                $numeroImagens = count(array_filter($upload['name']));

                for ($i = 0; $i < $numeroImagens; $i++) {
                    $nameImagem = $portSlug . rand() . '.jpg'; //Definindo um novo nome para o arquivo
                    move_uploaded_file($upload['tmp_name'][$i], $dirImagens . $nameImagem); //Fazer upload do arquivo
                    $image = WideImage::load($dirImagens . $nameImagem);
                    $image = $image->resize(null, '400', 'inside', 'any');
                    $image = $image->crop('center', 'center', '100%', 400);
                    $image->saveToFile($dirImagens . $nameImagem);
                    $pathImage = $baseDiretorio . $nameImagem;

                    $sqlImagem = $pdo->prepare("INSERT INTO portfolio_imagem VALUES (null,?,?,?)");
                    $sqlImagem->execute(array($portId, $nameImagem, $pathImage));
                };
            }

            echo "atualizado";
        } catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Portfólio", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "Deletar":
        try {

            $Imagens = $pdo->prepare("SELECT * FROM portfolio_imagem WHERE img_port_id = ?");
            $Imagens->execute([$portId]);
            $dadosFotos = $Imagens->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dadosFotos as $fotos) {
                $idFoto = $fotos['img_id'];
                $NomeFoto = $fotos['img_nome'];

                $sqlDeletar = $pdo->prepare("DELETE FROM portfolio_imagem WHERE img_id = ?");
                $sqlDeletar->execute([$idFoto]);

                unlink($dirImagens . $NomeFoto);
            }

            $sql = $pdo->prepare("DELETE FROM portfolios WHERE port_id = ?");
            $sql->execute([$portId]);

            echo 'deletado';
        } catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Portfólio", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "deletarImagem":
        try {
            $ImagemNome = $_POST['portImagemNome'];
        
            $dirImagens = $caminho . '../assets/img/portfolio/'; //Diretório das imagens
        
            unlink($dirImagens . $ImagemNome);
        
            $sql = $pdo->prepare("DELETE FROM portfolio_imagem WHERE img_id = :id");
            $sql->bindParam(':id', $portId);
            $sql->execute();
        
            echo 'sucesso';
        } catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Portfólio", [$e->getMessage(), $e->getLine()]);
        }
    break;
}

