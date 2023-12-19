<?php
    require_once('../../models/Platform.php'); 

    function initConnectionDB() {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = 'root';
        $db_db = 'Bliblioteca_series';
       
        $mysqli = @new mysqli(
          $db_host,
          $db_user,
          $db_password,
          $db_db
        );
          
        if ($mysqli->connect_error) {
          echo 'Errno: '.$mysqli->connect_errno;
          echo '<br>';
          echo 'Error: '.$mysqli->connect_error;
          exit();
        }
      
        echo 'Success: A proper connection to MySQL was made.';
        echo '<br>';
        echo 'Host information: '.$mysqli->host_info;
        echo '<br>';
        echo 'Protocol version: '.$mysqli->protocol_version;
      
        $mysqli->close();
    }
    function listPlatforms() {

        $model = new Platform; 
        $platformList = $model->getAll();
        $platformObjectArray = [];

        foreach($platformList as $platformItem){
            $platformObject = new Platform($platformItem->getId(), $platformItem->getName()); 
            array_push($platformObjectArray, $platformObject); 
        }
        return $platformObjectArray; 
    }
?>