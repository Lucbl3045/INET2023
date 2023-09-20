<?php
$host = $_ENV["MYSQL_HOST"];
$db   = $_ENV["MYSQL_DB"];
$user = $_ENV["MYSQL_USR"];
$pass = $_ENV["MYSQL_PWD"];
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
GLOBAL $pdo; 
$pdo = new PDO($dsn, $user, $pass, $options);
