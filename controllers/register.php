<?php
Auth::admin();
if ($_POST['isAdmin']==="1"){
    $userid = Auth::register(null, $_POST["password"], 1);
} else {
    $userid = Auth::register(null, $_POST["password"], 0);
    $zone = DB::getZonesAssoc()[$_POST["zona"]];
    
    DB::addMedic($_POST["dni"], $_POST["nombre"], $_POST["apellido"], $userid, $zone );

}
include_once "partials/nuevoUsuario.php";