<?php 

if(!isset($_SESSION)){
    session_start();
}

$caminho = $_SESSION['caminho'];
    
include $caminho . 'system/conexao.php';

//listar arquivos
//$folder_name = '../../uploads/';
$dirImagens = $caminho . '../assets/img/galeria/'; //Diretório das imagens
$baseDiretorio = $baseUrl .  'assets/img/galeria/'; //Endereço completo

$result = array();
$files = scandir($dirImagens);
$output = '<div class="row">';
if(false !== $files){
    foreach($files as $file)
    {
        if('.' !=  $file && '..' != $file)
        {
            $output .= '
                <div class="col-md-2 text-center mt-3 mb-3">
                    <img src="'.$baseDiretorio.$file.'" class="img-thumbnail" />
                    <button type="button" class="btn btn-danger btn-sm btn-block remove_image" id="'.$file.'">Apagar</button>
                </div>
                ';
            }
    }
}
$output .= '</div>';
echo $output;


//deletar imagem pasta e banco
if(isset($_POST["name"])){
    //pasta
    $filename = $dirImagens.$_POST["name"];
    unlink($filename);

    //Banco
    $nomeArquivo = $_POST['name'];
    $sql = $pdo->prepare("DELETE FROM galerias WHERE gal_nome = '$nomeArquivo'");
    $sql->execute();

}