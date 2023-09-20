<?php

class DB {
    static function userLogin($id){
        GLOBAL $pdo;
        $stmt = $pdo->prepare("SELECT constrasenia FROM usuarios WHERE usuarioID = ?");
        $stmt->execute([$id]);
        return $stmt === false ? false : $stmt->fetchColumn();
    }

    static function isAdmin($id){
        GLOBAL $pdo;
        $stmt = $pdo->prepare("SELECT esAdmin FROM usuarios WHERE usuarioID = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() === 1;
    }

    static function register($user, $hash, $isAdmin){
        GLOBAL $pdo;
        return $pdo->prepare("INSERT INTO usuarios VALUES(?, ?, ?)")
            ->execute([$user, $hash, $isAdmin]);
    }
}