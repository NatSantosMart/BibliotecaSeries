<?php
require_once('../../models/Serie.php');
require_once('../../models/ActorsSeries.php');
require_once('../../models/LanguageSeriesAudio.php');
require_once('../../models/LanguageSeriesSubtitles.php');

function listSeries() {
    $model = new Serie(null, null, null, null); 
    $seriesList = $model->getAll();
    $seriesObjectArray = [];

    foreach($seriesList as $serieItem){
        $seriesObject = new Serie($serieItem->getId(), $serieItem->getTitle(),  $serieItem->getPlatformId(),  $serieItem->getDirectorId()); 
        array_push($serieObjectArray, $seriesObject); 
    }
    return $seriesObjectArray; 
}

function storeSeries($title, $platformId, $directorId, $actors, $languagesAudio, $languagesSubtitles) {
    $newSeries = new Serie(null, $title, $platformId, $directorId);
    $seriesCreated = $newSeries->store();

    if ($seriesCreated) {
        $seriesId = $newSeries->getId();

        // Asociar actores a la serie
        foreach ($actors as $actorId) {
            ActorSeriesModel::associateActorToSeries($seriesId, $actorId);
        }

        // Asociar idiomas de audio a la serie
        foreach ($languagesAudio as $languageId) {
            LanguageSeriesAudioModel::associateLanguageToSeries($languageId, $seriesId);
        }

        // Asociar idiomas de subtítulos a la serie
        foreach ($languagesSubtitles as $languageId) {
            LanguageSeriesSubtitlesModel::associateLanguageToSeries($languageId, $seriesId);
        }
    }

    return $seriesCreated;
}

function updateSeries($seriesId, $title, $platformId, $directorId) {
    $series = new Serie($seriesId, $title, $platformId, $directorId);
    $seriesEdited = $series->update();

    return $seriesEdited;
}

function deleteSeries($seriesId) {
    $series = new Serie($seriesId, null, null, null);
    $seriesDeleted = $series->delete();

    return $seriesDeleted;
}

function getSeriesData($idSeries) {
    $series = new Serie($idSeries, null, null, null);
    $seriesObject = $series->getItem();

    return $seriesObject;
}
?>
