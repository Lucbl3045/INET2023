<?php
use League\Csv\Writer;


[$columnNames, $results] = DB::getAllEntries($table);

$csv = Writer::createFromFileObject(new SplTempFileObject());

$csv->insertOne($columnNames);
$csv->insertAll($results);

$csv->output("$table.csv");
die;

