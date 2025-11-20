<?php

$host = "localhost";
$db = "upload";
$user = "php";
$passwd = 123456;

$mysqli = new mysqli($host, $user, $passwd, $db);
if($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados!");
}