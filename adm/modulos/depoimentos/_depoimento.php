<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

$depID = $_POST['depID'];
$depNome = $_POST['depNome'];
$depEmpresa = $_POST['depEmpresa'];
$depTexto = $_POST['depTexto'];
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");

switch ($Acao) {
    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE depoimentos SET dep_nome = ?, dep_empresa = ?, dep_texto = ? WHERE dep_id = ?");
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
            $sql = $pdo->prepare("INSERT INTO depoimentos VALUES (null,?,?,?)");
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
        $sql = $pdo->prepare("DELETE FROM depoimentos WHERE dep_id = ?");
        $sql->execute([$depID]);
        echo 'deletado';
        break;
}