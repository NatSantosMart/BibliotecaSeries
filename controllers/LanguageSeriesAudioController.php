<?php
    require_once('../../models/LanguageSeriesAudio.php'); 
   
    function listLanguageAudiosForSeries($series_id) {
        $model = new LanguageSeriesAudio($series_id, null); 
        $languageList = $model->getAll();
        return $languageList; 
    }

    function storeLanguageAudioForSeries($seriesId, $languageId){ 
        $newLanguageAudio = new LanguageSeriesAudio($seriesId, $languageId);
        return $languageCreated = $newLanguageAudio->store(); 
    }
    
    function updateLanguageAudioForSeries($seriesId, $languageId){ 
        $newLanguageAudio = new LanguageSeriesAudio($seriesId, $languageId);
        return $languageEdited = $newLanguageAudio->update(); 
    }

    function deleteLanguageAudioForSeries($seriesId, $languageId){
        $language = new LanguageSeriesAudio($seriesId, $languageId);
        $languageDeleted = $language->delete();

        return $languageDeleted; 
    }
    function getLanguageAudioDataForSeries($languageId){
        $language = new LanguageSeriesAudio(null, $languageId); 
        $languageObject = $language->getItem(); 

        return $languageObject; 
    }
?>