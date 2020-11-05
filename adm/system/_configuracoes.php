<?php

require_once("conexao.php");
require './lib/WideImage.php';

if (!empty($_POST)) {

    $dirImagens = '../../assets/img/'; //Diretório das imagens
    $baseDiretorio = $baseUrl . 'assets/img/'; //Endereço completo

    if (!empty($_FILES['confLogo']['name'])) {

        $new_name = 'logo.png'; //Definindo um novo nome para o arquivo
        move_uploaded_file($_FILES['confLogo']['tmp_name'], $dirImagens . $new_name); //Fazer upload do arquivo
        $image = WideImage::load($dirImagens . $new_name);
        $image = $image->resize(null, '150', 'fill', 'any');
        $image->saveToFile($dirImagens . $new_name);
        $pathlogo = $baseDiretorio . $new_name;

        $sql = $pdo->prepare("UPDATE CONFIGURACOES SET CONF_LOGO = '$pathlogo' WHERE CONF_ID = 1");
        $sql->execute();
    } else {
    }

    if (!empty($_FILES['confFavicon']['name'])) {

        $new_name = 'favicon.png'; //Definindo um novo nome para o arquivo
        move_uploaded_file($_FILES['confFavicon']['tmp_name'], $dirImagens . $new_name); //Fazer upload do arquivo
        $image = WideImage::load($dirImagens . $new_name);
        $image = $image->resize('32', '32', 'fill', 'any');
        $image->saveToFile($dirImagens . $new_name);
        $pathfavicon = $baseDiretorio . $new_name;

        $sql = $pdo->prepare("UPDATE CONFIGURACOES SET CONF_FAVICON = '$pathfavicon' WHERE CONF_ID = 1");
        $sql->execute();
    } else {
    }

    $id = 1;
    $confNome = $_POST['confNome'];
    $confDescricao = $_POST['confDescricao'];
    $confEmail = $_POST['confEmail'];
    $confLink = $_POST['confLink'];
    $confTelefone = $_POST['confTelefone'];
    $confEndereco = $_POST['confEndereco'];
    $confCorPrincipal = $_POST['confCorPrincipal'];
    $confCorSecundaria = $_POST['confCorSecundaria'];
    $confInstagram = $_POST['confInstagram'];
    $confFacebook = $_POST['confFacebook'];
    $confYoutube = $_POST['confYoutube'];
    $confLinkedin = $_POST['confLinkedin'];

    $sql = $pdo->prepare("UPDATE CONFIGURACOES SET 
            CONF_NOME = ?,
            CONF_DESCRICAO = ?,
            CONF_EMAIL = ?,
            CONF_LINK = ?,
            CONF_TELEFONE = ?,
            CONF_ENDERECO = ?,
            CONF_COR_PRINCIPAL = ?,
            CONF_COR_SECUNDARIA = ?,
            CONF_INSTAGRAM = ?,
            CONF_FACEBOOK = ?,
            CONF_YOUTUBE = ?,
            CONF_LINKEDIN = ?
            WHERE CONF_ID = ?");
    $sql->execute([
        $confNome,
        $confDescricao,
        $confEmail,
        $confLink,
        $confTelefone,
        $confEndereco,
        $confCorPrincipal,
        $confCorSecundaria,
        $confInstagram,
        $confFacebook,
        $confYoutube,
        $confLinkedin,
        $id
    ]);

    echo 'sucesso';
} else {
    echo 'erro';
}
