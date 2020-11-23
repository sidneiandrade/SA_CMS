<?php
if(!isset($_SESSION)){
    session_start();
}
$caminho = $_SESSION['caminho'];

include $caminho . 'system/conexao.php';
include $caminho . 'configuracoes/_email.php';

$ID         = $_POST['ctaID'];
$Titulo     = $_POST['ctaTitulo'];
$Texto      = $_POST['ctaTexto'];
$TituloBtn  = $_POST['ctaTituloBtn'];
$UrlBtn     = $_POST['ctaUrlBtn'];
$CorBtn     = $_POST['ctaCorBtn'];
$Icone      = $_POST['ctaIcone'];
$Acao       = $_POST['Acao'];

switch ($Acao) {
    case "Salvar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO cta VALUES (null,?,?,?,?,?,?)");
            $sql->execute([$Titulo, $Texto, $TituloBtn, $UrlBtn, $CorBtn, $Icone]);
            $Id = $pdo->lastInsertId();
            $pdo->commit();
            $data = ['acao' => 'salvo', 'id' => $Id];
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo CTA", [$e->getMessage(), $e->getLine()]);
        }
        break;

    case "Atualizar":
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE cta SET cta_titulo = ?, cta_texto = ?, cta_titulo_btn = ?, cta_url_btn = ?, cta_cor_btn = ?, cta_icone = ? WHERE cta_id = ?");
            $sql->execute([$Titulo, $Texto, $TituloBtn, $UrlBtn, $CorBtn, $Icone, $ID]);
            $pdo->commit();
            echo 'atualizado';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            EnviarEmail("Erro Modulo CTA", [$e->getMessage(), $e->getLine()]);
        }
        break;
}