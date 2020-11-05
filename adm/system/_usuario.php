<?php
include 'conexao.php';

$usuID = $_POST['usuID'];
$usuNome = $_POST['usuNome'];
$usuEmail = $_POST['usuEmail'];
$usuSenha = $_POST['usuSenha'];
$usuStatus = $_POST['usuStatus'];
$usuNivel = (isset($_POST['usuNivel']) ? $_POST['usuNivel'] : 0);
$Acao = (isset($_POST['Acao']) ? $_POST['Acao'] : "");

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $cryptSenha = md5($_POST['usuSenha']);
            $sql = $pdo->prepare("INSERT INTO USUARIO VALUES (null,?,?,?,?,1,0)");
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

                $sql = $pdo->prepare("UPDATE USUARIO SET USU_NOME = ?, USU_EMAIL = ?, USU_NIVEL = ?, USU_STATUS = ?, USU_ERRO = ? WHERE USU_ID = ?");
                $sql->execute([$usuNome, $usuEmail, $usuNivel, $usuStatus, 0, $usuID]);
                $data = ['acao' => 'atualizado', 'msg' => 'Usuário Atualizada com Sucesso!'];
                header('Content-type: application/json');
                echo json_encode($data);
            } else {

                $cryptSenha = md5($_POST['usuSenha']);

                $sql = $pdo->prepare("UPDATE USUARIO SET USU_NOME = ?, USU_EMAIL = ?, USU_NIVEL = ?, USU_STATUS = ?, USU_SENHA = ?, USU_ERRO = ? WHERE USU_ID = ?");
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
        $list = $pdo->query("SELECT * FROM USUARIO WHERE USU_ID = $usuID")->fetchAll(PDO::FETCH_ASSOC);
        foreach($list as $value){}
        if($value['usu_nivel'] == 1){
            $data = ['acao' => '', 'msg' => 'Usuário Administrador não pode ser deletado!'];
            header('Content-type: application/json');
            echo json_encode($data);
        } else {
            $sql = $pdo->prepare("DELETE FROM USUARIO WHERE USU_ID = ? AND USU_NIVEL = ?");
            $sql->execute([$usuID, $usuNivel]);
            $data = ['acao' => 'deletado', 'msg' => 'Usuário Deletado com Sucesso!'];
            header('Content-type: application/json');
            echo json_encode($data);
        }
        
        break;
}
