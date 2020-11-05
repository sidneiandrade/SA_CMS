<?php
include 'conexao.php';

$desID = $_POST['desID'];
$desIcone = $_POST['desIcone'];
$desTitulo = $_POST['desTitulo'];
$desTexto = $_POST['desTexto'];
$desStatus = $_POST['desStatus'];
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO DESTAQUE VALUES (null,?,?,?,?,?)");
            $sql->execute([$desIcone, $desTitulo, $desTexto, $desStatus, 1]);
            $ID = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $ID];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE DESTAQUE SET DES_ICONE = ?, DES_TITULO = ?, DES_TEXTO = ?, DES_STATUS = ? WHERE DES_ID = ?");
            $sql->execute([$desIcone, $desTitulo, $desTexto, $desStatus, $desID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        $sql = $pdo->prepare("DELETE FROM DESTAQUE WHERE DES_ID = ?");
        $sql->execute([$desID]);
        echo 'deletado';
        break;
}