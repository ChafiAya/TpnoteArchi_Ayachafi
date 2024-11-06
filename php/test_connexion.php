<?php

include 'php/cnx/Connexion.php'; 
$connexion = new Connexion();
$dbConnection = $connexion->getConn();
try {
    $stmt = $dbConnection->query("SELECT 1"); 
    $result = $stmt->fetch(); 
    echo "Connection successful! Result: " . $result[0];
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage()); 
}
?>
