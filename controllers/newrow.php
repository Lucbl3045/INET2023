<?php
Auth::admin();
if (isset($table) && in_array($table, DB::$dataTables)){
    //
} else {
    throw new Exception("wrong table");
}


$idColumnName = DB::getTableColumns($table)[0];
$colTypes= DB::getTableColumnsTypes($table);

include "partials/newrow.php";