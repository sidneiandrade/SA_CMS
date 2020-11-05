<?php
include 'conexao.php';

$ID = $_POST['catID'];
$Nome = $_POST['catNome'];
$Slug = $_POST['catSlug'];
$Origem = $_POST['catOrigem'];
$Status = $_POST['catStatus'];
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");


switch ($Acao) {

    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE CATEGORIAS SET CAT_NOME = ?, CAT_SLUG = ?, CAT_ORIGEM = ?, CAT_STATUS = ? WHERE CAT_ID = ?");
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
            $sql = $pdo->prepare("INSERT INTO CATEGORIAS VALUES (null,?,?,?,?)");
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
        $sql = $pdo->prepare("DELETE FROM CATEGORIAS WHERE CAT_ID = ?");
        $sql->execute([$ID]);
        echo 'deletado';
        break;
}
