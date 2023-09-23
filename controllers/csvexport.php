<?php



$now = gmdate("D, d M Y H:i:s");
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
header("Last-Modified: {$now} GMT");

// force download  
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// disposition / encoding on response body
header("Content-Disposition: attachment;filename=export.csv");
header("Content-Transfer-Encoding: binary");




[$columnNames, $results] = DB::getAllEntries($table);





ob_start();
$df = fopen("php://output", 'w');
fputcsv($df, $columnNames);
foreach ($results as $row) {
    fputcsv($df, $row);
}
fclose($df);
echo ob_get_clean();
exit();
