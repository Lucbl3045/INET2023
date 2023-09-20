<?php
class Auth {
    static function user(){
        self::startIfNot();
        if (!isset($_SESSION["id"])){
            include "views/login.php";
            exit;
        }

    }
    static function admin(){
        self::startIfNot();

    }
    static function login($user, $password){
        self::startIfNot();
    }

    private static function startIfNot(){
        if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    }
}