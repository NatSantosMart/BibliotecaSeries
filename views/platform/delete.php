<?php 
    require_once('../../controllers/PlatformController.php'); 
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
                $idPlatform = $_GET['platformId']; 
                $platform = new Platform($idPlatform, null);
                $isAssociated = $platform->isPlatformAssociatedToSeries();

                if ($isAssociated) {
                    MessageHTML::showErrorMessage('No se puede eliminar la plataforma porque está asociada a una serie. ', 'Debe eliminar primero la serie.', 'list.php', 'Volver a intentarlo');
                } else {
                    $platformDeleted = deletePlatform($idPlatform);
                }
                if ($platformDeleted) {
                    MessageHTML::showSuccessMessage('Plataforma eliminada correctamente.', 'list.php', 'Volver al listado de plataformas');
                } else {
                    MessageHTML::showErrorMessage('La plataforma no se ha eliminado correctamente.', 'list.php', 'Volver a intentarlo');
                }

            ?>

        </div>
    </body>
</html>

