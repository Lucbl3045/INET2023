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

    static function  getTableColumnsTypes($table){
        GLOBAL $pdo;
        $stmt = $pdo->query("SHOW columns FROM $table");
        $columnsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $columnTypes=[];
        foreach ($columnsData as $col){
            $columnTypes[$col['Field']]=explode('(',$col['Type'])[0];
        } 
        return $columnTypes;
    }

    static function getTableColumns($table){
        GLOBAL $pdo;
        $stmt = $pdo->query("SHOW columns FROM $table");
        $columnsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $columnNames = array_map(fn($x):string => $x['Field'], $columnsData);
        return $columnNames;
    }

    static function getPage($table, $searchQuery, $page=0, $rowsPerPage=10){
        GLOBAL $pdo;
        $columnNames = self::getTableColumns($table);

        $selectClause="SELECT * FROM $table ";
        $countClause = "SELECT count(*) FROM $table ";
        $whereClause='';
        $limitClause='LIMIT '. $rowsPerPage*$page . ", $rowsPerPage";
        $fieldsset=0;
        if (isset($searchQuery)){
            foreach( $columnNames as $colName){
                $whereClause.= $fieldsset ? "OR " : 'WHERE ';		
                $whereClause.="({$colName} LIKE ? ) "; 
                $fieldsset++;
            }
        }
        $lengthStmt = $pdo->prepare($countClause.$whereClause);
        $resultStmt = $pdo->prepare($selectClause.$whereClause.$limitClause);
        if (isset($searchQuery)){
            $searchQuery = "%".$searchQuery."%";
            $repeatedQuery=array_fill(0, count($columnNames), $searchQuery);
            $lengthStmt->execute($repeatedQuery);
            $resultStmt->execute($repeatedQuery);
        } else {
            $lengthStmt->execute();
            $resultStmt->execute();
        }
        $length = $lengthStmt->fetchColumn();
        $results = $resultStmt->fetchAll(PDO::FETCH_ASSOC);
        return [$length, $results];
    }

    static function fetchRowFromTable($id, $table, $condRow){
        GLOBAL $pdo;
        $stmt = $pdo->prepare("SELECT * FROM $table WHERE $condRow = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function deleteRowFromTable($id, $table, $condRow){
        GLOBAL $pdo;
        $stmt = $pdo->prepare("DELETE FROM $table WHERE $condRow = ?");
        $stmt->execute([$id]);
    }

    static function updateRowFromTable($table, $postVars){
        GLOBAL $pdo;
        $postVars[] = $postVars[0];
        $columnNames = self::getTableColumns($table);
        $idColumnName = $columnNames[0];
    
        $updatequery="UPDATE {$table} SET ";
        foreach ($columnNames as $colName){
            $updatequery.="{$colName}= ? , ";
        }
        $updatequery=substr($updatequery, 0,  strlen($updatequery)-2);
        $updatequery.=" WHERE {$idColumnName}= ? ";
        $stmt = $pdo->prepare($updatequery);
        $stmt->execute($postVars);
        
    }

}