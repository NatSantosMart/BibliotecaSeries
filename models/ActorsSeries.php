<?php
require_once(__DIR__ . '/../utils/DBConnection.php');

class ActorsSeries {
        public $series_id; 
        public $actor_id; 

        public function __construct($series_id, $actor_id){
            $this->series_id = $series_id; 
            $this->actor_id = $actor_id; 
        }
        public function setIdSeries($series_id){
            $this->series_id = $series_id; 
        }
        public function getIdSeries(){
            return $this->series_id; 
        }
        public function setIdActor($actor_id){
            $this->actor_id = $actor_id; 
        }
        public function getIdActor(){
            return $this->actor_id; 
        }
    public static function getActorsForSeries($seriesId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $query = $mysqli->query("SELECT actor_id FROM ActorSeries WHERE series_id = $seriesId");
        $actors = [];

        foreach ($query as $item) {
            $actors[] = $item["actor_id"];
        }
        return $actors;
    }

    public static function getSeriesForActor($actorId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $query = $mysqli->query("SELECT series_id FROM ActorSeries WHERE actor_id = $actorId");
        $series = [];

        foreach ($query as $item) {
            $series[] = $item["series_id"];
        }
        return $series;
    }

    public static function associateActorToSeries($seriesId, $actorId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $insertQuery = "INSERT INTO ActorSeries (series_id, actor_id) VALUES ($seriesId, $actorId)";

        $result = $mysqli->query($insertQuery);

        return $result;
    }
    function isActorAssociatedToSeries(){
        $mysqli = DBConnection::getInstance()->getConnection(); 
        $query = $mysqli->query('SELECT * FROM ActorSeries WHERE actor_id = ' . $this->actor_id);  
        $isAssociated = false; 

        if ($query->num_rows != 0) {
            $isAssociated = true; 
        }
        return $isAssociated;
    }
}
?>

