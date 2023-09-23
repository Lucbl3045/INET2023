<?php

class DB {

    static $dataTables = ["pacientes", "dispositivos", 
                          "llamadas", "usuarios",
                          "medicos",  "zonas"];


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
        $pdo->prepare("INSERT INTO usuarios VALUES(?, ?, ?)")
            ->execute([$user, $hash, $isAdmin]);
        return $pdo->lastInsertId();
    }

    static function getCalls($userID=false){
        GLOBAL $pdo;
        $query="SELECT 
                CONCAT(pacientes.nombre, ' ', pacientes.apellido) as nombrePaciente, 
                tiempoDeLlamada, 
                tiempoDeRespuesta, 
                CONCAT(nombreDispositivo, ' en ', ubicacion) as nombreDispositivo, 
                nivelDeEmergencia 
                FROM llamadas 
                INNER JOIN medicos ON medicos.medicoID = llamadas.medicoQueAtendioID 
                INNER JOIN usuarios ON usuarios.usuarioID = medicos.usuarioID 
                INNER JOIN pacientes ON pacientes.pacienteID=llamadas.pacienteID 
                INNER JOIN dispositivos ON dispositivos.dispositivoID = llamadas.dispositivoDeLlamadaID 
                INNER JOIN zonas ON zonas.zonaID = dispositivos.zonaID;
                ";
                
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

        $selectClause="SELECT ";
        foreach($columnNames as $col){
            if ($col!=="contrasenia"){
                $selectClause.=" $col , ";
            }
        }
        $selectClause=substr($selectClause, 0,  strlen($selectClause)-2);


        $selectClause.=" FROM $table ";
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


    static function getAllEntries($table){
        GLOBAL $pdo;
        $columnNames = self::getTableColumns($table);
        $returnCols=[];
        $selectClause="SELECT ";
        foreach($columnNames as $col){
            if ($col!=="contrasenia"){
                $selectClause.=" $col , ";
                $returnCols[]=$col;
            }
        }
        $selectClause=substr($selectClause, 0,  strlen($selectClause)-2);
        $selectClause.=" FROM $table ";

        $resultStmt = $pdo->prepare($selectClause);
        $resultStmt->execute();
        $results = $resultStmt->fetchAll(PDO::FETCH_ASSOC);
        return [$returnCols, $results];
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
            if ($colName!=="contrasenia"){
                $updatequery.="{$colName}= ? , ";
            }
        }
        $updatequery=substr($updatequery, 0,  strlen($updatequery)-2);
        $updatequery.=" WHERE {$idColumnName}= ? ";
        $stmt = $pdo->prepare($updatequery);
        $stmt->execute($postVars);
        
    }


    static function createRowFromTable($table, $postVars){
        GLOBAL $pdo;
        $columnNames = self::getTableColumns($table);
        $idColumnName = $columnNames[0];
    
        $updatequery="INSERT INTO {$table} VALUES( ";
        foreach ($columnNames as $colName){
            if ($colName!=="contrasenia"){
                $updatequery.=" ? , ";
            }
        }
        $updatequery=substr($updatequery, 0,  strlen($updatequery)-2). ') ';
        $stmt = $pdo->prepare($updatequery);
        $stmt->execute($postVars);
        return  $pdo->lastInsertId();
        
    }

    static function getZones($fetchWhat){
        GLOBAL $pdo;
        
        $rows="nombre";
        if ($fetchWhat === PDO::FETCH_KEY_PAIR){
            $rows = "$rows, zonaID";
        }
        $stmt = $pdo->prepare("SELECT $rows FROM zonas");
        $stmt->execute();
        return $stmt->fetchAll($fetchWhat);
    }

    static function getZonesList(){
        return self::getZones(PDO::FETCH_COLUMN);
    }
    static function getZonesAssoc(){
        return self::getZones(PDO::FETCH_KEY_PAIR);
    }

    static function addMedic($dni, $fName, $lName, $userID, $zoneID){
        GLOBAL $pdo;
        $pdo->prepare("INSERT INTO medicos VALUES(null, ?, ?, ?, ?, ?)")
            ->execute([$dni, $fName, $lName, $userID, $zoneID]);
        
    }

    static function avgResponseTime($initDate, $endDate, $zone, $origin, $medic){
        GLOBAL $pdo;
        [$whereclause, $params] = DB::genWhereForStats($initDate, $endDate, $zone, $origin, $medic);
        $query = "SELECT AVG(tiempoDeRespuesta-tiempoDeLlamada) ";
        $query.=DB::$fromQueryForStats.$whereclause;
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    static function amountOfResponses($initDate, $endDate, $zone, $origin, $medic){
        GLOBAL $pdo;
        [$whereclause, $params] = DB::genWhereForStats($initDate, $endDate, $zone, $origin, $medic);
        $query = "SELECT COUNT(*) ";
        $query.=DB::$fromQueryForStats.$whereclause;
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    static function responsesPerLevel($initDate, $endDate, $zone, $origin, $medic){
        return self::responsesPerX($initDate, $endDate, $zone, $origin, $medic, "nivelDeEmergencia");
    }

    static function responsesPerOrigin($initDate, $endDate, $zone, $origin, $medic){
        return self::responsesPerX($initDate, $endDate, $zone, $origin, $medic, "ubicacion");
    }

    static function responsesPerZone($initDate, $endDate, $zone, $origin, $medic){
        return self::responsesPerX($initDate, $endDate, $zone, $origin, $medic, "zonaID");
    }

    private static function responsesPerX($initDate, $endDate, $zone, $origin, $medic, $perWhat){
        GLOBAL $pdo;
        [$whereclause, $params] = self::genWhereForStats($initDate, $endDate, $zone, $origin, $medic);
        $query = "SELECT $perWhat, COUNT(*) as count";
        $query.=self::$fromQueryForStats.$whereclause;
        $query.="GROUP BY $perWhat";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }


    private static $fromQueryForStats=" FROM llamadas INNER JOIN dispositivos ON dispositivos.dispositivoID = dispositivoDeLlamadaID ";
    

    static function genWhereForStats($initDate, $endDate, $zone, $origin, $medic){
        $clause = "WHERE 1 ";
        $params=[];
        if ($initDate!==false){
            $clause .= " AND ? < tiempoDeLlamada ";
            $params[]=$initDate;
        }

        if ($endDate!==false){
            $clause .= " AND tiempoDeRespuesta < ? ";
            $params[]=$endDate;
        }

        if ($zone!==false){
            $clause .= " AND zonaID = ? ";
            $params[]=$zone;
        }
        if ($origin!==false){
            $clause .= " AND ubicacion = ? ";
            $params[]=$origin;
        }
        if ($medic!==false){
            $clause .= " AND medicoQueAtendioID = ? ";
            $params[]=$medic;
        }
        return [$clause, $params];
    }

}