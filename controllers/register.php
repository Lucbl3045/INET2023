<?php
Auth::register($_POST["id"], $_POST["password"], 0);
include_once "controllers/index.php";