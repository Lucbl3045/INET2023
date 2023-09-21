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

$columnNames = DB::getTableColumns($table);
$idColumnName = $columnNames[0];
//$row = DB::fetchRowFromTable($id, $table, $idColumnName);

$postVars = [];
foreach ($columnNames as $colName){
    $postVars[] = $_POST[$colName] === "" ? null : $_POST[$colName] ;
}

DB::updateRowFromTable($table, $postVars);
$row = DB::fetchRowFromTable($id, $table, $idColumnName);


include 'partials/resetrow.php';


