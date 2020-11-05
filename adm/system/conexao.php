<?php

$db = 'sa_db_system';
$login = 'root';
$password = '';

$baseUrl = 'http://localhost/system/';

try {
    $pdo = new PDO('mysql:host=localhost;dbname='.$db, $login, $password);

    //Comentar quando fizer a publicação
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'Não foi possível conectar, tente novamente mais tarde!';
}
