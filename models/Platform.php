<?php
    require_once(__DIR__ . '/../utils/DBConnection.php');
    
    class Platform {
        private $id; 
        private $name; 

        public function __construct($idPlatform, $namePlatform){
            $this->id = $idPlatform; 
            $this->name = $namePlatform; 
        }
        
        public function setId($id){
            $this->id = $id; 
        }
        public function getId(){
            return $this->id; 
        }
        public function setName($name){
            $this->name = $name; 
        }
        public function getName(){
            return $this->name; 
        }

        function getAll() {
            $mysqli = DBConnection::getInstance()->getConnection(); // Uso del Singleton
            $query = $mysqli->query('SELECT * FROM Platform');  
            $listData = []; 

            foreach($query as $item){
                $itemObject = new Platform($item["id"], $item["name"]); 
                array_push($listData, $itemObject); 
            }
            $mysqli->close(); //Cierre de conexión  
            return $listData; 
        }

        function store(){
            $platformCreated = false; 
            $mysqli = DBConnection::getInstance()->getConnection(); 

            $resultExistingPlatform = $mysqli->query("SELECT name FROM Platform WHERE name = '$this->name'");

            if ($resultExistingPlatform->num_rows == 0) {
                // No existe una plataforma con el mismo nombre, se puede crear
                $insertQuery = "INSERT INTO Platform (name) VALUES ('$this->name')";

                if ($resultInsert = $mysqli->query($insertQuery)) {
                    $platformCreated = true;
                }
            }
            $mysqli->close(); 
            return $platformCreated; 
        }   
        
        function delete(){
            $platformDeleted = false; 
            $mysqli = DBConnection::getInstance()->getConnection(); 

            $resultExistingPlatform = $mysqli->query("SELECT id FROM Platform WHERE id = '$this->id'");

            if ($resultExistingPlatform->num_rows == 0) {
                $deleteQuery = "DELETE FROM Platform where id =" . $this->id;

                if ($resultInsert = $mysqli->query($insertQuery)) {
                    $platformCreated = true;
                }
            }
            $mysqli->close(); 
            return $platformCreated; 
        }
        public function showSuccessMessage($message, $link, $linkText) {
            HTMLMensajeGenerador::generarMensaje($message, true, $link, $linkText);
        }
    
        public function showErrorMessage($message, $link, $linkText) {
            HTMLMensajeGenerador::generarMensaje($message, false, $link, $linkText);
        } 
    }
?>