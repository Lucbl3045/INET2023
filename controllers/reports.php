<?php
Auth::admin();

foreach(["initDate", "endDate", "zone", "origin", "medic"] as $varName){
    if (isset($_POST[$varName])){
        if ($_POST[$varName]===""){
            $$varName=false;
        } else {
            $$varName=$_POST[$varName];
        }
    } else {
        $$varName=false;
    }
}

$showMedicName = $medic!==false; 

if ($medic !==false){
    $medicdata=DB::fetchRowFromTable($medic, "medicos", "medicoID");
}


$avgdata = DB::avgResponseTime($initDate, $endDate, $zone, $origin, $medic);
$amountdata = DB::amountOfResponses($initDate, $endDate, $zone, $origin, $medic);
$perLevels = DB::responsesPerLevel($initDate, $endDate, $zone, $origin, $medic);
$perOrigins = DB::responsesPerOrigin($initDate, $endDate, $zone, $origin, $medic);
$perZones = DB::responsesPerZone($initDate, $endDate, $zone, $origin, $medic);

$zones=DB::getZonesAssoc();




$content="views/reports.php";
include "views/_layout.php";