<?php

include 'conexao.php';

$usuarioemail = $_POST['usuarioemail'];
$senhausuario = $_POST['senha'];

$sql = $pdo->prepare("SELECT * FROM usuario WHERE usu_email = ?");
$sql->execute([$usuarioemail]);
$total = $sql->rowCount();

if ($total > 0) {

    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($info as $value) {
        $usuID = $value['usu_id'];
        $usuEmail = $value['usu_email'];
        $usuSenha = $value['usu_senha'];
        $usuNome = $value['usu_nome'];
        $usuNivel = $value['usu_nivel'];
        $usuStatus = $value['usu_status'];
        $usuErro = $value['usu_erro'];
    }

    if($usuErro > 5 || $usuStatus == 0){

        $sql = $pdo->prepare("UPDATE usuario SET usu_status = ? WHERE usu_id = ?");
        $sql->execute([0, $usuID]);

        $data = ['resultado' => 'bloqueado', 'msg' => 'Atenção!'];
        header('Content-type: application/json');
        echo json_encode($data);

    } else {

        $senhacriptografada = md5($senhausuario);

        if ($senhacriptografada == $usuSenha) {

            session_start();
            $_SESSION['usuario'] = $usuNome;
            $_SESSION['id'] = $usuID;
            $_SESSION['email'] = $usuEmail;
            $_SESSION['nivel'] = $usuNivel;
            $_SESSION['tempo_login'] = time();

            $sql = $pdo->prepare("UPDATE usuario SET usu_erro = ? WHERE usu_id = ?");
            $sql->execute([0, $usuID]);

            $data = ['resultado' => 'sucesso', 'msg' => 'OK!'];
            header('Content-type: application/json');
            echo json_encode($data);

        } else {

            $sql = $pdo->prepare("UPDATE usuario SET usu_erro = usu_erro+? WHERE usu_id = ?");
            $sql->execute([1, $usuID]);

            $data = ['resultado' => 'erro', 'msg' => 'Usuário ou Senha invalido!'];
            header('Content-type: application/json');
            echo json_encode($data);

        }
    }
    
} else {

    $data = ['resultado' => 'erro', 'msg' => 'Usuário ou Senha invalido!'];
    header('Content-type: application/json');
    echo json_encode($data);
    
}
