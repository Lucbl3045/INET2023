<?php
Auth::admin();
if (isset($table) && in_array($table, DB::$dataTables)){
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
$row = DB::fetchRowFromTable($id, $table, $idColumnName);

include "partials/resetrow.php";