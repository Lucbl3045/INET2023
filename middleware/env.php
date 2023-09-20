<?php
require_once("vendor/autoload.php");
//Autoloading fails sometimes.
include 'classes/Auth.php';
include 'classes/DB.php';
$dotenv = Dotenv\Dotenv::createImmutable(".");
$dotenv->load();
