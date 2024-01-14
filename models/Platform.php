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

        function update(){
            $platformEdited = false; 
            $mysqli = DBConnection::getInstance()->getConnection(); 

            // TO DO: Comprobar que existe antes de editar
            $resultExistingPlatform = $mysqli->query("SELECT name FROM Platform WHERE name = '$this->name' AND id != $this->id");

            if ($resultExistingPlatform->num_rows == 0) {
                // No existe una plataforma con el mismo nombre, se puede editar
                $updateQuery = "UPDATE Platform set name = '" . $this->name . "' WHERE id = " . $this->id;

                if ($resultUpdate = $mysqli->query($updateQuery)) {
                    $platformEdited = true;
                }
            }
            $mysqli->close(); 
            return $platformEdited; 
        }  
        
        function delete(){
            $platformDeleted = false; 
            $mysqli = DBConnection::getInstance()->getConnection(); 

            //Comprueba que existe la plataforma antes de borrarla
            $resultExistingPlatform = $mysqli->query('SELECT id FROM Platform WHERE id = ' . $this->id);

            if ($resultExistingPlatform->num_rows != 0) { 
                $deleteQuery = "DELETE FROM Platform where id = " . $this->id;

                if ($result = $mysqli->query($deleteQuery)) {
                    $platformDeleted = true;
                }
            }
            $mysqli->close(); 
            return $platformDeleted; 
        }

        function getItem(){
            $mysqli = DBConnection::getInstance()->getConnection(); 
            $query = $mysqli->query('SELECT * FROM Platform WHERE id = ' . $this->id);  

            foreach($query as $item){
                $itemObject = new Platform($item["id"], $item["name"]); 
                break; 
            }
            //$mysqli->close();
            return $itemObject; 
        }

        function isPlatformAssociatedToSeries(){
            $mysqli = DBConnection::getInstance()->getConnection(); 
            $query = $mysqli->query('SELECT * FROM Series WHERE idPlatform = ' . $this->id);  
            $isAssociated = false; 

            if ($query->num_rows != 0) {
                $isAssociated = true; 
            }
            return $isAssociated; 
        }
    }
?>