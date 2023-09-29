<?php
if ($_POST["id"]){
    return $currentCalls = DB::getCalls();
}