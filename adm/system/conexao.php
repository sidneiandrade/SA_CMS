<?php

$db = 'sa_db_system';
$login = 'root';
$password = '';

$baseUrl = 'http://local.system.com/';

date_default_timezone_set('America/Sao_Paulo');

global $pdo;

try {
    $pdo = new PDO('mysql:host=localhost;dbname='.$db, $login, $password, 
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    //Comentar quando fizer a publicação
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'Não foi possível conectar, tente novamente mais tarde!';
}
