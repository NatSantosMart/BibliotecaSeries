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
                    MessageHTML::showSuccessMessage('Director eliminado correctamente.', 'list.php', 'Volver al listado de directors');
                } else {
                    MessageHTML::showErrorMessage('La director no se ha eliminado correctamente.', 'list.php', 'Volver a intentarlo');
                }

            ?>

        </div>
    </body>
</html>

