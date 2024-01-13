<?php
require_once(__DIR__ . '/../utils/DBConnection.php');

class ActorSeriesModel {
    public static function getActorsForSeries($seriesId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $query = $mysqli->query("SELECT actor_id FROM ActorSeries WHERE series_id = $seriesId");
        $actors = [];

        foreach ($query as $item) {
            $actors[] = $item["actor_id"];
        }

        $mysqli->close();
        return $actors;
    }

    public static function getSeriesForActor($actorId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $query = $mysqli->query("SELECT series_id FROM ActorSeries WHERE actor_id = $actorId");
        $series = [];

        foreach ($query as $item) {
            $series[] = $item["series_id"];
        }

        $mysqli->close();
        return $series;
    }

    public static function associateActorToSeries($seriesId, $actorId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $insertQuery = "INSERT INTO ActorSeries (series_id, actor_id) VALUES ($seriesId, $actorId)";

        $result = $mysqli->query($insertQuery);

        $mysqli->close();

        return $result;
    }
}
?>

