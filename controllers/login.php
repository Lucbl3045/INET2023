<?php
if (Auth::login($_POST["id"], $_POST["password"])===false){
    header("HX-Retarget: #errors");
    header("HX-Reswap: innerHTML");
    include 'partials/failLogin.html';
    exit;
}
include_once "controllers/index.php";