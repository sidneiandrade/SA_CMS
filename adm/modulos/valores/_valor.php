<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'configuracoes/_email.php';

$valID          = $_POST['ID'];
$valTitulo      = $_POST['valTitulo'];
$valValor       = $_POST['valValor'];
$valFrequencia  = $_POST['valFrequencia'];
$valTexto       = $_POST['valTexto'];
$valUrl         = $_POST['valUrl'];
$valBtnTitulo   = $_POST['valBtnTitulo'];
$valDestaque    = $_POST['valDestaque'];
$valStatus      = $_POST['valStatus'];
$Acao           = $_POST['Acao'];

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO valores VALUES (null,?,?,?,?,?,?,?,?)");
            $sql->execute([$valTitulo, $valValor, $valFrequencia, $valTexto, $valUrl, $valBtnTitulo, $valDestaque, $valStatus]);
            $ID = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $ID];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Valores", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE valores SET 
                    val_titulo = ?, 
                    val_valor = ?, 
                    val_frequencia = ?, 
                    val_texto = ?, 
                    val_url = ?, 
                    val_btn_titulo = ?, 
                    val_destaque = ?, 
                    val_status = ? 
                    WHERE val_id = ?");
            $sql->execute([$valTitulo, $valValor, $valFrequencia, $valTexto, $valUrl, $valBtnTitulo, $valDestaque, $valStatus, $valID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Valores", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "Deletar":
        try{
            $pdo->beginTransaction();
            $sql = $pdo->prepare("DELETE FROM VALORES WHERE VAL_ID = ?");
            $sql->execute([$valID]);
            $pdo->commit();
            echo 'deletado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Valores", [$e->getMessage(), $e->getLine()]);
        }
        
        break;
}