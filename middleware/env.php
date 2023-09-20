<?php
echo "test";
require_once("vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(".");
$dotenv->load();
