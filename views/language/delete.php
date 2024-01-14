<?php 
    require_once('../../controllers/LanguageController.php'); 
    require_once('../../models/LanguageSeriesAudio.php'); 
    require_once('../../models/LanguageSeriesSubtitles.php'); 
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

                $languageAudio = new LanguageSeriesAudio(null, $idLanguage);
                $isAssociatedAudio = $languageAudio->isLanguageAssociatedToSeries();

                $languageSubtitles = new LanguageSeriesSubtitles(null, $idLanguage);
                $isAssociatedSubtitles = $languageSubtitles->isLanguageAssociatedToSeries();
               
                if ($isAssociatedAudio || $isAssociatedSubtitles) {
                    MessageHTML::showErrorMessage('No se puede eliminar el idioma porque está asociado a una serie.' , ' Debe eliminar primero la serie.','list.php', 'Volver a intentarlo');
                } else {
                    $languageDeleted = deleteLanguage($idLanguage);
                }

                if ($languageDeleted) {
                    MessageHTML::showSuccessMessage('Idioma eliminado correctamente.', 'list.php', 'Volver al listado de plataformas');
                } else {
                    MessageHTML::showErrorMessage('El idioma no se ha eliminado correctamente.', 'list.php', 'Volver a intentarlo');
                }

            ?>

        </div>
    </body>
</html>

