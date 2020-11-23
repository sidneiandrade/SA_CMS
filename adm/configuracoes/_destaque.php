<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . '_email.php';

$desID      = $_POST['desID'];
$desIcone   = $_POST['desIcone'];
$desTitulo  = $_POST['desTitulo'];
$desTexto   = $_POST['desTexto'];
$desStatus  = $_POST['desStatus'];
$Acao       = $_POST['Acao'];

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO destaque VALUES (null,?,?,?,?,?)");
            $sql->execute([$desIcone, $desTitulo, $desTexto, $desStatus, 1]);
            $ID = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $ID];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Destaque", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE destaque SET des_icone = ?, des_titulo = ?, des_texto = ?, des_status = ? WHERE des_id = ?");
            $sql->execute([$desIcone, $desTitulo, $desTexto, $desStatus, $desID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Destaque", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "Deletar":
        try{
            $pdo->beginTransaction();
            $sql = $pdo->prepare("DELETE FROM destaque WHERE des_id = ?");
            $sql->execute([$desID]);
            $pdo->commit();
            echo 'deletado';
        } catch(Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Destaque", [$e->getMessage(), $e->getLine()]);
        }
        
        break;
}