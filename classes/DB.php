<?php

class DB {
    static function userLogin($id){
        GLOBAL $pdo;
        $stmt = $pdo->prepare("SELECT contrasenia FROM usuarios WHERE usuarioID = ?");
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

    static function getCurrentVisits($userID=false){
        return self::getVisits(false, $userID);
    }
    static function getPreviousVisits($userID=false){
        return self::getVisits(true, $userID);
    }

    static function getVisits($isDone, $userID=false){
        GLOBAL $pdo;
        $isnull = $isDone ? "NOT" : "";
        $query="SELECT * FROM visitas 
                INNER JOIN medicoDeVisita ON visitas.visitaID = medicoDeVisita.visitaID 
                INNER JOIN medicos ON medicos.medicoID = medicoDeVisita.medicoID 
                INNER JOIN usuarios ON usuarios.usuarioID = medicos.usuarioID 
                WHERE visitas.tiempoSalida IS $isnull NULL";
        if ($userID === false){
            $stmt = $pdo->prepare($query);
            $stmt->execute();
        } else {
            $query.=" AND usuarios.usuarioID = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$userID]);
        }   
        
        if ($stmt === false){
            return false;    
        }
        return $stmt->fetchAll();
    }

}