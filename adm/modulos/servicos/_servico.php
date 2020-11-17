<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

$servID         = $_POST['servID'];
$servIcone      = $_POST['servIcone'];
$servTitulo     = $_POST['servTitulo'];
$servTexto      = $_POST['servTexto'];
$Acao           = $_POST['Acao'];

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO servicos VALUES (null,?,?,?)");
            $sql->execute([$servIcone, $servTitulo, $servTexto]);
            $IDServico = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $IDServico];
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
            $sql = $pdo->prepare("UPDATE servicos SET serv_icone = ?, serv_titulo = ?, serv_texto = ? WHERE serv_id = ?");
            $sql->execute([$servIcone, $servTitulo, $servTexto, $servID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        $sql = $pdo->prepare("DELETE FROM servicos WHERE serv_id = ?");
        $sql->execute([$servID]);
        echo 'deletado';
        break;
}