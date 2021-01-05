<?php

if(!isset($_SESSION)){
    session_start();
}

include '../system/conexao.php';

$Acao = $_POST['Acao'];

switch ($Acao) {
    case "editar":
        $ID  = $_POST['socialID'];
        $sql = $pdo->prepare("SELECT * FROM redes_sociais WHERE social_id = $ID");
        $sql->execute();
        $dadosRedes = $sql->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'Icone'   => $dadosRedes[0]['social_icone'],
            'Titulo'  => $dadosRedes[0]['social_titulo'], 
            'Url'     => $dadosRedes[0]['social_url'],
            'ID'      => $dadosRedes[0]['social_id'],
            'Acao'    => 'editar'
        ];
        header('Content-type: application/json');
        echo json_encode($data);
    break;

    case "atualizar":
        $ID      = $_POST['socialID'];
        $Icone   = $_POST['Icone'];
        $Titulo  = $_POST['Titulo'];
        $Url     = $_POST['Url'];

        $sql = $pdo->prepare("UPDATE redes_sociais SET social_icone = ?, social_titulo = ?, social_url = ? WHERE social_id = ?");
        $sql->execute([$Icone,$Titulo,$Url,$ID]);

        $data = ['acao' => 'atualizado'];
        header('Content-type: application/json');
        echo json_encode($data);
    break;

    case "salvar":
        $Icone = $_POST['Icone'];
        $Titulo = $_POST['Titulo'];
        $Url = $_POST['Url'];

        $sql = $pdo->prepare("INSERT INTO redes_sociais  (social_icone, social_titulo, social_url) VALUES (?,?,?)");
        $sql->execute([$Icone,$Titulo,$Url]);

        $data = ['acao' => 'salvo'];
        header('Content-type: application/json');
        echo json_encode($data);
    break;

    case "deletar":
        $ID = $_POST['socialID'];
        $sql = $pdo->prepare("DELETE FROM redes_sociais WHERE social_id = $ID")->execute();

        $data = ['acao' => 'deletado'];
        header('Content-type: application/json');
        echo json_encode($data);
    break;
}


