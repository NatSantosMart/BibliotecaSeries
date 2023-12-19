<?php
    require_once('../../models/Platform.php'); 

    
    function listPlatforms() {

        $model = new Platform(null, null); 
        $platformList = $model->getAll();
        $platformObjectArray = [];

        foreach($platformList as $platformItem){
            $platformObject = new Platform($platformItem->getId(), $platformItem->getName()); 
            array_push($platformObjectArray, $platformObject); 
        }
        return $platformObjectArray; 
    }
?>