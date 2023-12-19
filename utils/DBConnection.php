<?php
class DBConnection {
    private static $instance = null;
    private $conn;
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_password = 'root';
    private $db_db = 'Biblioteca_series';

    // Constructor privado para evitar la creación de instancias externas
    private function __construct() {
        $this->conn = @new mysqli(
            $this->db_host,
            $this->db_user,
            $this->db_password,
            $this->db_db
        );

        // Manejo de errores de conexión
        if ($this->conn->connect_error) {
            die('Errno: ' . $this->conn->connect_errno . '<br>Error: ' . $this->conn->connect_error);
        }
    }

    // Método para obtener la instancia única de la conexión
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Método para obtener la conexión a la base de datos
    public function getConnection() {
        return $this->conn;
    }
}
