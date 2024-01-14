<?php
    require_once('../../models/ActorsSeries.php'); 
   
    function listActorsForSeries($series_id) {
        $model = new ActorsSeries($series_id, null); 
        $actorList = $model->getAll();
        return $actorList; 
    }

    function storeActorForSeries($seriesId, $actorId){ 
        $newActor = new ActorsSeries($seriesId, $actorId);
        return $actorCreated = $newActor->store(); 
    }
    
    function updateActorForSeries($seriesId, $actorId){ 
        $newActor = new ActorsSeries($seriesId, $actorId);
        return $actorEdited = $newActor->update(); 
    }

    function deleteActorForSeries($seriesId, $actorId){
        $actor = new ActorsSeries($seriesId, $actorId);
        $actorDeleted = $actor->delete();

        return $actorDeleted; 
    }
    function getActorDataForSeries($actorId){
        $actor = new ActorsSeries(null, $actorId); 
        $actorObject = $actor->getItem(); 

        return $actorObject; 
    }
?>