<?php
require_once(__DIR__ . '/../utils/DBConnection.php');

class LanguageSeriesSubtitles {
    public static function getLanguagesSubtitlesForSeries($seriesId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $query = $mysqli->query("SELECT language_id FROM LanguageSeriesSubtitles WHERE series_id = $seriesId");
        $languagesSubtitles = [];

        foreach ($query as $item) {
            $languagesSubtitles[] = $item["language_id"];
        }

 
        return $languagesSubtitles;
    }

    public static function associateLanguageToSeries($seriesId, $languageId) {
        $mysqli = DBConnection::getInstance()->getConnection();

        $insertQuery = "INSERT INTO LanguageSeriesSubtitles (series_id, language_id) VALUES ($seriesId, $languageId)";

        $result = $mysqli->query($insertQuery);

        return $result;
    }
}
?>
