<?php
class Auth {
    static function user(){
        self::startIfNot();
        if (!isset($_SESSION["id"])){
            $content="views/login.php";
            include "views/_layout.php";
            exit;
        }

    }
    static function admin(){
        self::startIfNot();
        if (!isset($_SESSION["id"])){
            $content="views/login.php";
            include "views/_layout.php";
            exit;
        }
        if (!isset($_SESSION["isAdmin"])){
            $includeNav=true;
            $content="views/index.php";
            include "views/_layout.php";
            exit;
        }

    }
    static function login($user, $password){
        self::startIfNot();
        $hash = DB::userLogin($user);
        if ($hash===false){
            return false;
        }
        if (password_verify($password, $hash)){
            $_SESSION["id"] = $user;
            $_SESSION["isAdmin"] = DB::isAdmin($user);
        } else {
            return false;
        }
    }

    static function logout(){
        self::startIfNot();
        session_unset();
        session_destroy();
        self::user();
    }

    static function register($user, $password, $isAdmin){
        self::startIfNot();
        self::admin();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return DB::register($user, $hash, $isAdmin);
    }


    static function startIfNot(){
        if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    }
}