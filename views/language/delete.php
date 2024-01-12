<?php 
    require_once('../../controllers/LanguageController.php'); 
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
                $idLanguage = $_GET['languageId']; 
                $languageDeleted = deleteLanguage($idLanguage);

                if ($languageDeleted) {
                    MessageHTML::showMessage('Idioma eliminado correctamente.', true, 'list.php', 'Volver al listado de plataformas');
                } else {
                    MessageHTML::showMessage('El idioma no se ha eliminado correctamente.', false, 'list.php', 'Volver a intentarlo');
                }

            ?>

        </div>
    </body>
</html>

