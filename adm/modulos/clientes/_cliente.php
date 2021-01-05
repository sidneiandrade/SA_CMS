<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

//require dirname(__DIR__ , 2 ). '/vendor/autoload.php';

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';
include $caminho . 'configuracoes/_email.php';

$Id         = $_POST['Id'];
$Empresa    = $_POST['cliEmpresa'];
$Imagem     = $_POST['cliNomeImagem'];
$Status     = $_POST['cliStatus'];
$Acao       = $_POST['Acao'];

$dirImagens = $caminho . '../assets/img/clientes/'; //Diretório das imagens
$baseDiretorio = $baseUrl .  'assets/img/clientes/'; //Endereço completo

if (!is_dir($dirImagens)) {
    mkdir($dirImagens, 0755, true); // Cria uma pasta imagens
}
    
switch ($Acao){
    case "Salvar":
        try {
            $Imagem = 'Cliente-' . rand() . '.png'; //Definindo um novo nome para o arquivo
            move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $Imagem); //Fazer upload do arquivo
            $image = WideImage::load($dirImagens . $Imagem);
            $image = $image->resize('400', null, 'fill', 'any');
            $image->saveToFile($dirImagens . $Imagem, 9);
            $pathImage = $baseDiretorio . $Imagem;
    
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO clientes VALUES (null,?,?,?,?)");
            $sql->execute([$Empresa, $Imagem, $pathImage, $Status]);
            $id = $pdo->lastInsertId();
            $pdo->commit();
    
            $data = ['acao' => 'salvo', 'id' => $id];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Clientes", [$e->getMessage(), $e->getLine()]);
        }
    break;

    case "Atualizar":
        try{
            if (!empty($_FILES['arquivoImagem']['name'])) {

                unlink($dirImagens . $Imagem); // deletar a imagem na pasta

                $Imagem = 'Cliente-' . rand() . '.png'; //Definindo um novo nome para o arquivo
                move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $Imagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $Imagem);
                $image = $image->resize('400', null, 'fill', 'any');
                $image->saveToFile($dirImagens . $Imagem, 9);
                $pathImage = $baseDiretorio . $Imagem;
                $pdo->beginTransaction();
                $sql = $pdo->prepare("UPDATE clientes SET cli_imagem = ?, cli_url_imagem = ?  WHERE cli_id = ?");
                $sql->execute([$Imagem, $pathImage, $Id]);
                $pdo->commit();
            }

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE clientes SET cli_empresa = ?, cli_status = ? WHERE cli_id = ?");
            $sql->execute([$Empresa, $Status, $Id]);
            $pdo->commit();

            echo 'atualizado';
        }
        catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Clientes", [$e->getMessage(), $e->getLine()]);
        }
    break;

    case "Deletar":
        try{
            unlink($dirImagens . $Imagem);

            $sql = $pdo->prepare("DELETE FROM clientes WHERE cli_id = ?");
            $sql->execute([$Id]);
            echo 'deletado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Clientes", [$e->getMessage(), $e->getLine()]);
        }
    break;
}
