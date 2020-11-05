<?php

require_once("conexao.php");

$ID = $_POST['ID'];
$Acao = $_POST['Acao'];
$Titulo = $_POST['Titulo'];
$Descricao = $_POST['Descricao'];
$Url = $_POST['Url'];
$Icone = $_POST['Icone'];
$Status = $_POST['Status'];
$Ordem = $_POST['Ordem'];

switch ($Acao) {
    case "adicionar":
        $sql = $pdo->prepare("UPDATE MODULOS SET MOD_STATUS = ? WHERE MOD_ID = ?");
        $sql->execute([1,$ID]);
    break;

    case "retirar":
        $sql = $pdo->prepare("UPDATE MODULOS SET MOD_STATUS = ? WHERE MOD_ID = ?");
        $sql->execute([0,$ID]);
    break;

    case "Salvar":
        $sql = $pdo->prepare("INSERT INTO MODULOS (MOD_ID, MOD_TITULO, MOD_DESCRICAO, MOD_URL, MOD_ICONE, MOD_STATUS, MOD_ORDEM) VALUES (NULL,?,?,?,?,?,?)");
        $sql->execute([$Titulo,$Descricao,$Url,$Icone,1,$Ordem]);
        $id = $pdo->lastInsertId();
        $data = ['acao' => 'salvo', 'id' => $id];
        header('Content-type: application/json');
        echo json_encode($data);
    break;

    case "Atualizar":
        $sql = $pdo->prepare("UPDATE MODULOS SET MOD_TITULO = ?, MOD_DESCRICAO = ?, MOD_URL = ?, MOD_ICONE = ?, MOD_STATUS = ?, MOD_ORDEM = ? WHERE MOD_ID = ?");
        $sql->execute([$Titulo,$Descricao,$Url, $Icone, $Status,$Ordem, $ID]);
        echo "atualizado";
    break;

    case "deletar":
        $sql = $pdo->prepare("DELETE FROM MODULOS WHERE MOD_ID = ?");
        $sql->execute([$ID]);
        echo "deletado";
    break;
}
