<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';
include $caminho . 'configuracoes/_email.php';

$Id         = $_POST['Id'];
$Nome       = $_POST['mbNome'];
$Imagem     = $_POST['mbNomeImagem'];
$Cargo      = $_POST['mbCargo'];
$Facebook   = $_POST['mbFacebook'];
$Twitter    = $_POST['mbTwitter'];
$Instagram  = $_POST['mbInstagram'];
$Linkedin   = $_POST['mbLinkedin'];
$Status     = $_POST['mbStatus'];
$Acao       = $_POST['Acao'];

$dirImagens = $caminho . '../assets/img/equipe/'; //Diretório das imagens
$baseDiretorio = $baseUrl .  'assets/img/equipe/'; //Endereço completo

if (!is_dir($dirImagens)) {
    mkdir($dirImagens, 0755, true); // Cria uma pasta imagens
}

switch ($Acao){
    case "Salvar":
        try {
            $Imagem = 'Membro-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
            move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $Imagem); //Fazer upload do arquivo
            $image = WideImage::load($dirImagens . $Imagem);
            $image = $image->resize('600', '600', 'fill', 'any');
            $image->saveToFile($dirImagens . $Imagem, 60);
            $pathImage = $baseDiretorio . $Imagem;
    
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO membros VALUES (null,?,?,?,?,?,?,?,?,?)");
            $sql->execute([$Nome, $Imagem, $pathImage, $Cargo, $Facebook, $Twitter, $Instagram, $Linkedin, $Status]);
            $id = $pdo->lastInsertId();
            $pdo->commit();
    
            $data = ['acao' => 'salvo', 'id' => $id];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Membros", [$e->getMessage(), $e->getLine()]);
        }
    break;

    case "Atualizar":
        try{
            if (!empty($_FILES['arquivoImagem']['name'])) {

                unlink($dirImagens . $Imagem);

                $Imagem = 'Membro-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
                move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $Imagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $Imagem);
                $image = $image->resize('600', '600', 'fill', 'any');
                $image->saveToFile($dirImagens . $Imagem, 60);
                $pathImage = $baseDiretorio . $Imagem;
                $pdo->beginTransaction();
                $sql = $pdo->prepare("UPDATE membros SET mb_imagem = ?, mb_url_imagem = ?  WHERE mb_id = ?");
                $sql->execute([$Imagem, $pathImage, $Id]);
                $pdo->commit();
            }

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE membros SET mb_nome = ?, mb_cargo = ?, mb_facebook = ? , mb_twitter = ?,  mb_instagram = ?, mb_linkedin = ?, mb_status = ?  WHERE mb_id = ?");
            $sql->execute([$Nome, $Cargo, $Facebook, $Twitter, $Instagram, $Linkedin, $Status, $Id]);
            $pdo->commit();

            echo 'atualizado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Membros", [$e->getMessage(), $e->getLine()]);
        }
    break;

    case "Deletar":
        try{
            unlink($dirImagens . $Imagem);

            $sql = $pdo->prepare("DELETE FROM membros WHERE mb_id = ?");
            $sql->execute([$Id]);
            echo 'deletado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Membros", [$e->getMessage(), $e->getLine()]);
        }
    break;
}

