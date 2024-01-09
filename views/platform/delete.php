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
                $idPlatform = $_POST['platformId']; 
                $platformDeleted = deletePlatform($idPlatform);

                if ($platformDeleted) {
                    MessageHTML::showMessage('Plataforma eliminada correctamente.', true, 'list.php', 'Volver al listado de plataformas');
                } else {
                    MessageHTML::showMessage('La plataforma no se ha eliminado correctamente.', false, 'list.php', 'Volver a intentarlo');
                }

            ?>

        </div>
    </body>
</html>

