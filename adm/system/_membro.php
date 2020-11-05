<?php
include 'conexao.php';
require './lib/WideImage.php';

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

$dirImagens = '../../assets/img/equipe/'; //Diretório das imagens
$baseDiretorio = $baseUrl . 'assets/img/equipe/'; //Endereço completo


switch ($Acao){
    case "Salvar":
        try {
            $Imagem = 'Membro-' . rand() . '.jpg'; //Definindo um novo nome para o arquivo
            move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $Imagem); //Fazer upload do arquivo
            $image = WideImage::load($dirImagens . $Imagem);
            $image = $image->resize('600', '600', 'fill', 'any');
            $image->saveToFile($dirImagens . $Imagem);
            $pathImage = $baseDiretorio . $Imagem;
    
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO MEMBROS VALUES (null,?,?,?,?,?,?,?,?,?)");
            $sql->execute([$Nome, $Imagem, $pathImage, $Cargo, $Facebook, $Twitter, $Instagram, $Linkedin, $Status]);
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
                move_uploaded_file($_FILES['arquivoImagem']['tmp_name'], $dirImagens . $Imagem); //Fazer upload do arquivo
                $image = WideImage::load($dirImagens . $Imagem);
                $image = $image->resize('600', '600', 'fill', 'any');
                $image->saveToFile($dirImagens . $Imagem);
            }

            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE MEMBROS SET MB_NOME = ?, MB_CARGO = ?, MB_FACEBOOK = ? , MB_TWITTER = ?,  MB_INSTAGRAM = ?, MB_LINKEDIN = ?, MB_STATUS = ?  WHERE MB_ID = ?");
            $sql->execute([$Nome, $Cargo, $Facebook, $Twitter, $Instagram, $Linkedin, $Status, $Id]);
            $pdo->commit();

            echo 'atualizado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    break;

    case "Deletar":
        try{
            unlink($dirImagens . $Imagem);

            $sql = $pdo->prepare("DELETE FROM MEMBROS WHERE MB_ID = ?");
            $sql->execute([$Id]);
            echo 'deletado';
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    break;
}
