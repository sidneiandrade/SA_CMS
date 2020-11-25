<?php

  include '../adm/system/conexao.php';

  // $sql = $pdo->query("SELECT * FROM configuracoes");
  // $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
  // $emailContato = $dados[0]['conf_email'];

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $assunto = $_POST['assunto'];
  $mensagem = $_POST['mensagem'];

  try{
    
    $pdo->beginTransaction();
    $sql = $pdo->prepare("INSERT INTO contatos VALUES (null,?,?,?,?,?,0,null,now())");
    $sql->execute([$nome, $email, $telefone, $assunto, $mensagem]);
    $pdo->commit();
    $data = ['result' => 'salvo', 'mensagem' => 'Mensagem Enviada com Sucesso!'];
    header('Content-type: application/json');
    echo json_encode($data);

} catch(Exception $e){
    $pdo->rollBack();
    $data = ['result' => 'erro' ,'mensagem' => 'Erro'];
    header('Content-type: application/json');
    echo json_encode($data);
}

?>
