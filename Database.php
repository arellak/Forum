<?php
class Database {
    public $pdo;
    public $path;

    public function __construct($path) {
        $this->path = $path;
    }

    public function connect(): PDO {
        if($this->pdo == null) {
            try {
                $this->pdo = new PDO("sqlite:" . $this->path);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return $this->pdo;
    }

    public function close() {
        if($this->pdo != null) {
            try {
                $this->pdo = null;
            } catch(PDOException $e) {
                echo "Couldn't close connection: " . $e->getMessage();
            }
        }
    }

    public static function truncateTable($dbName, $tableName) {
        $db = new Database($dbName);
        $db->connect();

        $sql = "delete from $tableName;";
        $stmt = $db->pdo->prepare($sql);
        $stmt->execute();

        $db->close();
    }

}