<?php
Auth::user();

if ($_SESSION["isAdmin"]){
    $currentVisits = DB::getCurrentVisits();
    $previousVisits = DB::getPreviousVisits();
} else {
    $currentVisits = DB::getCurrentVisits($_SESSION["id"]);
    $previousVisits = DB::getPreviousVisits($_SESSION["id"]);
}


$content="views/visits.php";
include "views/_layout.php";