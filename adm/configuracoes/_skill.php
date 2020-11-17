<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

$ID      = $_POST['ID'];
$Titulo  = $_POST['skTitulo'];
$Valor   = $_POST['skValor'];
$Status  = $_POST['skStatus'];
$Acao    = $_POST['Acao'];

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO skills VALUES (null,?,?,?)");
            $sql->execute([$Titulo, $Valor, $Status]);
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
            $sql = $pdo->prepare("UPDATE skills SET sk_titulo = ?, sk_valor = ?, sk_status = ? WHERE sk_id = ?");
            $sql->execute([$Titulo, $Valor, $Status, $ID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        $sql = $pdo->prepare("DELETE FROM skills WHERE sk_id = ?");
        $sql->execute([$ID]);
        echo 'deletado';
        break;
}