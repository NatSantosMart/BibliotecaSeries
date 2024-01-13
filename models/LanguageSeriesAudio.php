<?php
require_once(__DIR__ . '/../utils/DBConnection.php');

class LanguageSeriesAudioModel {
    public static function getLanguagesAudioForSeries($seriesId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $query = $mysqli->query("SELECT language_id FROM LanguageSeriesAudio WHERE series_id = $seriesId");
        $languagesAudio = [];

        foreach ($query as $item) {
            $languagesAudio[] = $item["language_id"];
        }

        $mysqli->close();
        return $languagesAudio;
    }

    public static function associateLanguageToSeries($seriesId, $languageId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $insertQuery = "INSERT INTO LanguageSeriesAudio (series_id, language_id) VALUES ($seriesId, $languageId)";

        $result = $mysqli->query($insertQuery);

        $mysqli->close();

        return $result;
    }
}
?>
