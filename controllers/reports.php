<?php
Auth::admin();

$initDate = $_POST["initDate"] ?? false;
$endDate = $_POST["endDate"] ?? false;
$zone = $_POST["zone"] ?? false;
$origin = $_POST["origin"] ?? false;
$medic = $_POST["medic"] ?? false;
$showMedicName = $medic!==false; 

if ($medic !==false){
    $medicdata=DB::fetchRowFromTable($medic, "medicos", "medicoID");
}


$avgdata = DB::avgResponseTime($initDate, $endDate, $zone, $origin, $medic);
$amountdata = DB::amountOfResponses($initDate, $endDate, $zone, $origin, $medic);
$perLevels = DB::responsesPerLevel($initDate, $endDate, $zone, $origin, $medic);
$perOrigins = DB::responsesPerOrigin($initDate, $endDate, $zone, $medic);
$perZones = DB::responsesPerZone($initDate, $endDate, $origin, $medic);

$zones=DB::getZonesList();




$content="views/reports.php";
include "views/_layout.php";