<?php

$Acao = $_GET['acao'];

switch ($Acao){
    case 'expirou':
        session_start();
        session_unset();
        session_destroy();
        header("location: ../sessao");
    break;

    case 'sair':
        session_start();
        session_unset();
        session_destroy();
        header("location: ../");
    break;
}


