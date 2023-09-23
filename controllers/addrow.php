<?php
Auth::admin();
if (isset($table) && in_array($table, DB::$dataTables)){
    //
} else {
    throw new Exception("wrong table");
}


$columnNames = DB::getTableColumns($table);
$idColumnName = $columnNames[0];
//$row = DB::fetchRowFromTable($id, $table, $idColumnName);
$postVars = [];
foreach ($columnNames as $colName){
    if ($colName!=="contrasenia"){
        $postVars[] = ($_POST[$colName] === "" || $colName === $idColumnName) ? null : $_POST[$colName] ;
    }
}
$id = DB::createRowFromTable($table, $postVars);
$row = DB::fetchRowFromTable($id, $table, $idColumnName);


include 'partials/resetrow.php';


