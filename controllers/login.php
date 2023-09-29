<?php
if (Auth::login($_POST["id"], $_POST["password"])===false){
    header("HX-Retarget: #errors");
    header("HX-Reswap: innerHTML");
    include 'partials/failLogin.html';
    throw new AuthException("Failed to log in");
}
include_once "controllers/index.php";