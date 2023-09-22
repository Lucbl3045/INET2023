<?php

Auth::admin();

$zones=DB::getZonesList();
include_once "partials/medicOptions.php";