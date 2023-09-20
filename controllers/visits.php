<?php
Auth::user();

$currentVisits = DB::getCurrentVisits($_SESSION["id"]);
$previousVisits = DB::getPreviousVisits($_SESSION["id"]);

$content="views/visits.php";
include "views/_nav.php";