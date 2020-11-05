<?php
include 'conexao.php';

$valID = $_POST['ID'];
$valTitulo = $_POST['valTitulo'];
$valValor = $_POST['valValor'];
$valFrequencia = $_POST['valFrequencia'];
$valTexto = $_POST['valTexto'];
$valUrl = $_POST['valUrl'];
$valBtnTitulo = $_POST['valBtnTitulo'];
$valDestaque = $_POST['valDestaque'];
$valStatus = $_POST['valStatus'];
$Acao = $_POST['Acao'];

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO VALORES VALUES (null,?,?,?,?,?,?,?,?)");
            $sql->execute([$valTitulo, $valValor, $valFrequencia, $valTexto, $valUrl, $valBtnTitulo, $valDestaque, $valStatus]);
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
            $sql = $pdo->prepare("UPDATE VALORES SET 
                    VAL_TITULO = ?, 
                    VAL_VALOR = ?, 
                    VAL_FREQUENCIA = ?, 
                    VAL_TEXTO = ?, 
                    VAL_URL = ?, 
                    VAL_BTN_TITULO = ?, 
                    VAL_DESTAQUE = ?, 
                    VAL_STATUS = ? 
                    WHERE VAL_ID = ?");
            $sql->execute([$valTitulo, $valValor, $valFrequencia, $valTexto, $valUrl, $valBtnTitulo, $valDestaque, $valStatus, $valID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        $sql = $pdo->prepare("DELETE FROM VALORES WHERE VAL_ID = ?");
        $sql->execute([$valID]);
        echo 'deletado';
        break;
}