<?php 
    require_once('../../controllers/DirectorController.php'); 
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
                $idDirector = $_GET['directorId']; 
                $directorDeleted = deleteDirector($idDirector);

                if ($directorDeleted) {
                    MessageHTML::showMessage('Director eliminado correctamente.', true, 'list.php', 'Volver al listado de directors');
                } else {
                    MessageHTML::showMessage('La director no se ha eliminado correctamente.', false, 'list.php', 'Volver a intentarlo');
                }

            ?>

        </div>
    </body>
</html>

