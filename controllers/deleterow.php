<?php
Auth::admin();
$dataTables = ["pacientes", "dispositivos", 
               "especialidades", "llamadas", 
               "medicos", "visitas", "zonas"];
if (isset($table) && in_array($table, $dataTables)){
    //
} else {
    throw new Exception("wrong table");
}
if (isset($id)){
    $rowID=$id;
} else {
    throw new Exception("no ID");
}

$idColumnName = DB::getTableColumns($table)[0];
$row = DB::deleteRowFromTable($id, $table, $idColumnName);

echo "";