<?php
Auth::admin();

if (isset($_POST["table"]) && in_array($_POST["table"], DB::$dataTables)){
    $table=$_POST["table"];
} else {
    $table= $table ?? "pacientes";
}
if (isset($_POST["page"])){
    $page=intval($_POST["page"]);
} else {
    $page="0";
}

if (isset($_POST["query"])){
    $searchQuery=$_POST["query"];
} else {
    $searchQuery=null;
}
$rowsPerPage=10;
[$length, $rows] = DB::getPage($table, $searchQuery, $page, $rowsPerPage);
$pageCount=ceil($length/$rowsPerPage);

if ($page >=$pageCount-5){
	$startpage=max(0, $pageCount-10);
	$endpage=$pageCount;
} else if ($page>=5){
	$startpage=max(0, $page-5);
	$endpage=$page+5;
} else{
	$startpage=0;
	$endpage=10;
}

$pageSymbols=[];
$pageNumbers=[];
if ($page!=0){
	$pageSymbols=["<<", "<"];
	$pageNumbers=[0, $page-1];
}
if ($pageCount!=1){
    for ($i=$startpage;$i<$endpage;$i++){
        $pageSymbols[] = "$i";
        $pageNumbers[] = $i;
    }
}
if ($page!=$pageCount-1 && $pageCount!=0){
	$pageSymbols=[...$pageSymbols, ">", ">>"];
	$pageNumbers=[...$pageNumbers, $page+1, $pageCount-1];
}

$columnNames = DB::getTableColumns($table); 


$content="views/admin.php";
include "views/_layout.php";