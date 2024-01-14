<?php
    require_once('../../models/LanguageSeriesSubtitles.php'); 
   
    function listLanguageSubtitlessForSeries($series_id) {
        $model = new LanguageSeriesSubtitles($series_id, null); 
        $languageList = $model->getAll();
        return $languageList; 
    }

    function storeLanguageSubtitlesForSeries($seriesId, $languageId){ 
        $newLanguageSubtitles = new LanguageSeriesSubtitles($seriesId, $languageId);
        return $languageCreated = $newLanguageSubtitles->store(); 
    }
    
    function updateLanguageSubtitlesForSeries($seriesId, $languageId){ 
        $newLanguageSubtitles = new LanguageSeriesSubtitles($seriesId, $languageId);
        return $languageEdited = $newLanguageSubtitles->update(); 
    }

    function deleteLanguageSubtitlesForSeries($seriesId, $languageId){
        $language = new LanguageSeriesSubtitles($seriesId, $languageId);
        $languageDeleted = $language->delete();

        return $languageDeleted; 
    }
    function getLanguageSubtitlesDataForSeries($languageId){
        $language = new LanguageSeriesSubtitles(null, $languageId); 
        $languageObject = $language->getItem(); 

        return $languageObject; 
    }
?>