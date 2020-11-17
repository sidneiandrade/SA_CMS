<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
require $caminho . 'system/lib/WideImage.php';

if (!empty($_POST)) {

    $dirImagens     = $caminho . '../assets/img/'; //Diretório das imagens
    $baseDiretorio  = $baseUrl . 'assets/img/'; //Endereço completo

    if (!is_dir($dirImagens)) {
        mkdir($caminho . '../assets/img/', 0755, true); // Cria uma pasta imagens
    }

    if (!empty($_FILES['confLogo']['name'])) {

        $nomeLogo = $_POST['nomeLogo'];

        //$imgLogo = $pdo->query("SELECT conf_logo FROM configuracoes WHERE conf_id = 1")->fetchAll(PDO::FETCH_ASSOC);
        unlink($dirImagens . $nomeLogo);

        $new_name = 'logo-' . rand() . '.png'; //Definindo um novo nome para o arquivo
        move_uploaded_file($_FILES['confLogo']['tmp_name'], $dirImagens . $new_name); //Fazer upload do arquivo
        $image = WideImage::load($dirImagens . $new_name);
        $image = $image->resize(null, '150', 'fill', 'any');
        $image->saveToFile($dirImagens . $new_name);
        $pathlogo = $baseDiretorio . $new_name;

        $sql = $pdo->prepare("UPDATE configuracoes SET conf_logo = ?, conf_logo_url = ? WHERE conf_id = 1");
        $sql->execute([$new_name,$pathlogo]);
    } else {
    }

    if (!empty($_FILES['confFavicon']['name'])) {

        $nomeFavicon = $_POST['nomeFavicon'];

        //$imgFavicon = $pdo->query("SELECT conf_favicon FROM configuracoes WHERE conf_id = 1")->fetchAll(PDO::FETCH_ASSOC);
        unlink($dirImagens . $nomeFavicon);

        $new_name = 'favicon-' . rand() . '.png'; //Definindo um novo nome para o arquivo
        move_uploaded_file($_FILES['confFavicon']['tmp_name'], $dirImagens . $new_name); //Fazer upload do arquivo
        $image = WideImage::load($dirImagens . $new_name);
        $image = $image->resize('32', '32', 'fill', 'any');
        $image->saveToFile($dirImagens . $new_name);
        $pathfavicon = $baseDiretorio . $new_name;

        $sql = $pdo->prepare("UPDATE configuracoes SET conf_favicon = ?, conf_favicon_url = ? WHERE conf_id = 1");
        $sql->execute([$new_name, $pathfavicon]);
    } else {
    }

    $id = 1;
    $confNome           = $_POST['confNome'];
    $confDescricao      = $_POST['confDescricao'];
    $confEmail          = $_POST['confEmail'];
    $confLink           = $_POST['confLink'];
    $confTelefone       = $_POST['confTelefone'];
    $confEndereco       = $_POST['confEndereco'];
    $confCorPrincipal   = $_POST['confCorPrincipal'];
    $confCorSecundaria  = $_POST['confCorSecundaria'];
    $confInstagram      = $_POST['confInstagram'];
    $confFacebook       = $_POST['confFacebook'];
    $confYoutube        = $_POST['confYoutube'];
    $confLinkedin       = $_POST['confLinkedin'];

    $sql = $pdo->prepare("UPDATE configuracoes SET 
            conf_nome = ?,
            conf_descricao = ?,
            conf_email = ?,
            conf_link = ?,
            conf_telefone = ?,
            conf_endereco = ?,
            conf_cor_principal = ?,
            conf_cor_secundaria = ?,
            conf_instagram = ?,
            conf_facebook = ?,
            conf_youtube = ?,
            conf_linkedin = ?
            WHERE conf_id = ?");
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
