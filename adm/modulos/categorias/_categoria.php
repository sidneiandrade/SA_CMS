<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

$ID         = $_POST['catID'];
$Nome       = $_POST['catNome'];
$Slug       = $_POST['catSlug'];
$Origem     = $_POST['catOrigem'];
$Status     = $_POST['catStatus'];
$Acao       = $_POST['Acao'];


switch ($Acao) {

    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE categorias SET cat_nome = ?, cat_slug = ?, cat_origem = ?, cat_status = ? WHERE cat_id = ?");
            $sql->execute([$Nome, $Slug, $Origem, $Status, $ID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO categorias VALUES (null,?,?,?,?)");
            $sql->execute([$Nome, $Slug, $Origem, $Status]);
            $IdCategoria = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $IdCategoria];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        $sql = $pdo->prepare("DELETE FROM categorias WHERE cat_id = ?");
        $sql->execute([$ID]);
        echo 'deletado';
        break;
}
