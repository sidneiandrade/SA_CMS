<?php
include 'conexao.php';

$ID = $_POST['ID'];
$Pergunta = $_POST['pgPergunta'];
$Resposta = $_POST['pgResposta'];
$Status = $_POST['pgStatus'];
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");

switch ($Acao) {
    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE perguntas SET pg_pergunta = ?, pg_resposta = ?, pg_status = ? WHERE pg_id = ?");
            $sql->execute([$Pergunta, $Resposta, $Status, $ID]);
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
            $sql = $pdo->prepare("INSERT INTO perguntas VALUES (null,?,?,1,1)");
            $sql->execute([$Pergunta, $Resposta]);
            $Id = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $Id];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        $sql = $pdo->prepare("DELETE FROM perguntas WHERE pg_id = ?");
        $sql->execute([$ID]);
        echo 'deletado';
        break;
}
