<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'configuracoes/_email.php';

$numID          = $_POST['numID'];
$numIcone       = $_POST['numIcone'];
$numTitulo      = $_POST['numTitulo'];
$numNumero      = $_POST['numNumero'];
$numStatus      = $_POST['numStatus'];
$Acao           = $_POST['Acao'];

switch ($Acao) {
    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE numeros SET num_icone = ?, num_titulo = ?, num_numero = ?, num_status = ? WHERE num_id = ?");
            $sql->execute([$numIcone, $numTitulo, $numNumero, $numStatus, $numID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Números", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO numeros VALUES (null,?,?,?,1)");
            $sql->execute([$numIcone, $numTitulo, $numNumero]);
            $Id = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $Id];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Números", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "Deletar":
        try{
            $pdo->beginTransaction();
            $sql = $pdo->prepare("DELETE FROM numeros WHERE num_id = ?");
            $sql->execute([$numID]);
            $pdo->commit();
            echo 'deletado';
        } catch(Exception $e){
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo Números", [$e->getMessage(), $e->getLine()]);
        }
        
        break;
}
