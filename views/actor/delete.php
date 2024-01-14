<?php 
    require_once('../../controllers/ActorController.php'); 
    require_once('../../models/ActorsSeries.php'); 
    require_once('../../assets/scripts/showMessage.php');
    require_once('../../assets/scripts/validations.php');
    require_once('../../models/Actor.php');
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
                $actor = new ActorsSeries(null, $idActor);
                $isAssociated = $actor->isActorAssociatedToSeries();
                
                if ($isAssociated) {
                    MessageHTML::showErrorMessage('No se puede eliminar el actor porque está asociado a una serie.', ' Debe eliminar primero la serie.', 'list.php', 'Volver a intentarlo');
                } else {
                    $actorDeleted = deleteActor($idActor);
                }
                if ($actorDeleted) {
                    MessageHTML::showSuccessMessage('Actor eliminado correctamente.', 'list.php', 'Volver al listado de actors');
                } else {
                    MessageHTML::showErrorMessage('La actor no se ha eliminado correctamente.', 'list.php', 'Volver a intentarlo');
                }
            ?>

        </div>
    </body>
</html>

