<?php

if(!isset($_SESSION)){
    session_start();
}
$caminho = getcwd();

$expirou    = "location: ../sessao";
$logout     = "location: ../";

$Acao = $_GET['acao'];

switch ($Acao){
    case 'expirou':
        //session_start();
        session_unset();
        session_destroy();
        header($expirou);
    break;

    case 'sair':
        //session_start();
        session_unset();
        session_destroy();
        header($logout);
    break;
}


