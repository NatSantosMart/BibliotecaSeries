<?php 
    require_once('../../controllers/ActorController.php'); 
    require_once('../../assets/scripts/showMessage.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="../../assets/scripts/shared.js"></script> 
    </head>
    <style>
        .row {
            margin-top: 25px;    
        }  
        label{
            margin-top: 10px;   
        }
        
    </style>
    <body>
        <?php 
                $idActor = $_GET['actorId']; 
                $actorDeleted = deleteActor($idActor);

                if ($actorDeleted) {
                    MessageHTML::showMessage('Actor eliminado correctamente.', true, 'list.php', 'Volver al listado de actors');
                } else {
                    MessageHTML::showMessage('La actor no se ha eliminado correctamente.', false, 'list.php', 'Volver a intentarlo');
                }

            ?>

        </div>
    </body>
</html>

