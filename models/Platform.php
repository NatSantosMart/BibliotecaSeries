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
            return $this->$id; 
        }
        public function setName($name){
            $this->name = $name; 
        }
        public function getName(){
            return $this->$name; 
        }
        function getAll() {

            $mysqli = DBConnection::getInstance()->getConnection(); // Uso del Singleton
            $query = $mysqli->query("SELECT * FROM Platform");  
            $listData = []; 

            foreach($query as $item){
                $itemObject = new Platform($item["id"], $item["name"]); 
                array_push($listData, $itemObject); 
            }
            $mysqli->close(); //Cierre de conexión
    
            return $listData; 
        }

        
    }
?>