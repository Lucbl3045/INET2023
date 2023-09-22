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

$idColumnName = DB::getTableColumns($table)[0];
$colTypes= DB::getTableColumnsTypes($table);
$row = DB::fetchRowFromTable($id, $table, $idColumnName);

include "partials/editrow.php";