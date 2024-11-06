<?php
// Database connection constants
define('DB_HOST', '127.0.0.1'); 
define('DB_NAME', 'tp');
define('DB_PORT', '3306'); 
define('DB_USER', 'root');
define('DB_PSWD', ''); 

class Connexion {
    private $conn;

    public function getConn() {
        
        if ($this->conn == null) {
            try {
              
                $connString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";charset=utf8";
                
                $this->conn = new PDO($connString, DB_USER, DB_PSWD);
                
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
?>
