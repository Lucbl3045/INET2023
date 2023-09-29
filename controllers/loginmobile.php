<?php
if (Auth::login($_POST["id"], $_POST["password"])===false){
    return null;
}
else {
    return $_POST["id"];
}