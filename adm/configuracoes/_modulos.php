<?php

if(!isset($_SESSION)){
    session_start();
}

include '../system/conexao.php';

$ID         = $_POST['ID'];
$Acao       = $_POST['Acao'];
$Titulo     = (isset($_POST['Titulo']) ? $_POST['Titulo'] : "");
$Slug       = (isset($_POST['Slug']) ? $_POST['Slug'] : "");
$Descricao  = (isset($_POST['Descricao']) ? $_POST['Descricao'] : "") ;
$Url        = (isset($_POST['Url']) ? $_POST['Url'] : "");
$Icone      = (isset($_POST['Icone']) ? $_POST['Icone'] : "");
$Status     = (isset($_POST['Status']) ? $_POST['Status'] : 0);
$Menu       = (isset($_POST['Menu']) ? $_POST['Menu'] : 0);
$Ordem      = (isset($_POST['Ordem']) ? $_POST['Ordem'] : 0);

switch ($Acao) {
    case "adicionar":
        $sql = $pdo->prepare("UPDATE modulos SET mod_status = ? WHERE mod_id = ?");
        $sql->execute([1,$ID]);
    break;

    case "retirar":
        $sql = $pdo->prepare("UPDATE modulos SET mod_status = ? WHERE mod_id = ?");
        $sql->execute([0,$ID]);
    break;

    case "Salvar":
        $sql = $pdo->prepare("INSERT INTO modulos VALUES (NULL,?,?,?,?,?,?,?,?)");
        $sql->execute([$Titulo, $Slug, $Descricao, $Url, $Icone, 1, $Menu, $Ordem]);
        $id = $pdo->lastInsertId();
        $data = ['acao' => 'salvo', 'id' => $id];
        header('Content-type: application/json');
        echo json_encode($data);
    break;

    case "Atualizar":
        $sql = $pdo->prepare("UPDATE modulos SET mod_titulo = ?, mod_slug = ?, mod_descricao = ?, mod_url = ?, mod_icone = ?, mod_status = ?, mod_menu = ?, mod_ordem = ? WHERE mod_id = ?");
        $sql->execute([$Titulo, $Slug, $Descricao, $Url, $Icone, $Status, $Menu, $Ordem, $ID]);
        echo "atualizado";
    break;

    case "Deletar":
        $sql = $pdo->prepare("DELETE FROM modulos WHERE mod_id = ?");
        $sql->execute([$ID]);
        echo "deletado";
    break;
}
