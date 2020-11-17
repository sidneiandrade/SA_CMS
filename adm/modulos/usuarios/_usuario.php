<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';

$usuID          = $_POST['usuID'];
$usuNome        = $_POST['usuNome'];
$usuEmail       = $_POST['usuEmail'];
$usuSenha       = $_POST['usuSenha'];
$usuStatus      = $_POST['usuStatus'];
$usuNivel       = (isset($_POST['usuNivel']) ? $_POST['usuNivel'] : 0);
$Acao           = $_POST['Acao'];

$list = $pdo->query("SELECT * FROM usuario WHERE usu_id = $usuID")->fetchAll(PDO::FETCH_ASSOC);
foreach($list as $key => $value){}

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $cryptSenha = md5($_POST['usuSenha']);
            $sql = $pdo->prepare("INSERT INTO usuario VALUES (null,?,?,?,?,1,0)");
            $sql->execute([$usuNome, $usuEmail, $cryptSenha, $usuNivel]);
            $IDUsuario = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $IDUsuario, 'msg' => 'Usuário Salva com Sucesso!'];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
        }
        break;

    case "Atualizar":
        try {
            if ($_POST['usuSenha'] == "") {

                $sql = $pdo->prepare("UPDATE usuario SET usu_nome = ?, usu_email = ?, usu_nivel = ?, usu_status = ?, usu_erro = ? WHERE usu_id = ?");
                $sql->execute([$usuNome, $usuEmail, $usuNivel, $usuStatus, 0, $usuID]);
                $data = ['acao' => 'atualizado', 'msg' => 'Usuário Atualizada com Sucesso!'];
                header('Content-type: application/json');
                echo json_encode($data);
            } else {

                $cryptSenha = md5($_POST['usuSenha']);

                $sql = $pdo->prepare("UPDATE usuario SET usu_nome = ?, usu_email = ?, usu_nivel = ?, usu_status = ?, usu_senha = ?, usu_erro = ? WHERE usu_id = ?");
                $sql->execute([$usuNome, $usuEmail, $usuNivel, $usuStatus, $cryptSenha, 0, $usuID]);
                $data = ['acao' => 'atualizado', 'msg' => 'Usuário Atualizada com Sucesso!'];
                header('Content-type: application/json');
                echo json_encode($data);
            }
        } catch (Exception $e) {
            $erro = $e->getLine();
            $data = ['acao' => '', 'msg' => $erro];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        break;

    case "Deletar":
        
        if($value['usu_nivel'] == 1){
            $data = ['acao' => '', 'msg' => 'Usuário Administrador não pode ser deletado!'];
            header('Content-type: application/json');
            echo json_encode($data);
        } else {
            $sql = $pdo->prepare("DELETE FROM usuario WHERE usu_id = ? AND usu_nivel = ?");
            $sql->execute([$usuID, $usuNivel]);
            $data = ['acao' => 'deletado', 'msg' => 'Usuário Deletado com Sucesso!'];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        
        break;
}
