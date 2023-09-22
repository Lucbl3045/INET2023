<?php
Auth::user();

if ($_SESSION["isAdmin"]){
    $currentCalls = DB::getCalls();
} else {
    $currentCalls = DB::getCalls($_SESSION["id"]);
}


$content="views/calls.php";
include "views/_layout.php";