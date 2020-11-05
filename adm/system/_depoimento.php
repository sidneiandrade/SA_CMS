<?php
include 'conexao.php';

$depID = $_POST['depID'];
$depNome = $_POST['depNome'];
$depEmpresa = $_POST['depEmpresa'];
$depTexto = $_POST['depTexto'];
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");

switch ($Acao) {
    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE DEPOIMENTOS SET DEP_NOME = ?, DEP_EMPRESA = ?, DEP_TEXTO = ? WHERE DEP_ID = ?");
            $sql->execute([$depNome, $depEmpresa, $depTexto, $depID]);
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
            $sql = $pdo->prepare("INSERT INTO DEPOIMENTOS VALUES (null,?,?,?)");
            $sql->execute([$depNome, $depEmpresa, $depTexto]);
            $IdDepoimento = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $IdDepoimento];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Deletar":
        $sql = $pdo->prepare("DELETE FROM DEPOIMENTOS WHERE DEP_ID = ?");
        $sql->execute([$depID]);
        echo 'deletado';
        break;
}
