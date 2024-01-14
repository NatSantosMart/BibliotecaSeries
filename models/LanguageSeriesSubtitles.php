<?php
require_once(__DIR__ . '/../utils/DBConnection.php');

class LanguageSeriesSubtitles {
    public $series_id; 
    public $language_id; 

    public function __construct($series_id, $language_id){
        $this->series_id = $series_id; 
        $this->language_id = $language_id; 
    }
    public function setIdSeries($series_id){
        $this->series_id = $series_id; 
    }
    public function getIdSeries(){
        return $this->series_id; 
    }
    public function setIdLanguage($language_id){
        $this->language_id = $language_id; 
    }
    public function getIdLanguage(){
        return $this->language_id; 
    }
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
    function isLanguageAssociatedToSeries(){
        $mysqli = DBConnection::getInstance()->getConnection(); 
        $query = $mysqli->query('SELECT * FROM LanguageSeriesSubtitles WHERE language_id = ' . $this->language_id);  
        $isAssociated = false; 

        if ($query->num_rows != 0) {
            $isAssociated = true; 
        }
        return $isAssociated; 
    }
}
?>
