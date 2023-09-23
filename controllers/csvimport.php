<?php
use League\Csv\Reader;

if (!isset($table)){
    exit;
}


[$columnNames, $results] = DB::getAllEntries($table);

$reader = Reader::createFromPath($_FILES['csv']['tmp_name'], 'r');
$records = $reader->getRecords();
$fFlag=0;
foreach ($records as $record) {
    if ($fFlag){
        try{
            DB::createRowFromTable($table, $record);

        } catch (Exception) {

        }
    } else {
        $fFlag++;
    }
}




include "controllers/admin.php";
