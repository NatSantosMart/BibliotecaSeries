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
        <div class="container">
            <?php
                 $sendData = false; 
                 $action = isset($_GET['action']) ? $_GET['action'] : 'create';

                //Editar plataforma
                if ($action === 'edit') {
                    $idLanguage = $_GET['id']; 
                    $languageObject = getLanguageData($idLanguage); 

                    $languageEdited = false;  
                    if(isset($_POST['buttonCreateEdit'])){ 
                        $sendData = true; 
                    }
                    if($sendData){
                        if(isset($_POST['languageName'])){
                            $languageEdited =  updateLanguage($_POST['languageId'], $_POST['languageName'], $_POST['languageISOCode']); 
                        }
                    }
                } 
                //Crear plataforma
                else if ($action === 'create') {
                    $languageCreated = false;  
                    if(isset($_POST['buttonCreateEdit'])){ 
                        $sendData = true; 
                    }
                    if($sendData){
                        if(isset($_POST['languageName'])){
                            $languageCreated = storeLanguage($_POST['languageName'], $_POST['languageISOCode']); 
                        }
                    }
                }
                if(!$sendData) {

            ?>
    
            <div class="row">
                <div class="col-12">
                    <h1>Crear Idioma</h1>
                </div>
                <div class="col-12">
                    <form name="create_language" action="" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <label for="languageName" class="form-label">Nombre idioma</label>
                            <input id="languageName" name="languageName" type="text" placeholder="Introduce el nombre del idioma" class="form-control" required value="<?php if(isset($languageObject)) echo $languageObject->getName(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="languageId" value="<?php echo $idLanguage; ?>"/>
                            <?php 
                            }
                            ?>
                        </div>
                        <div class="col-6">
                            <label for="languageISOCode" class="form-label">ISO Code:</label>
                            <input id="languageISOCode" name="languageISOCode" type="text" placeholder="Introduce el idioma" class="form-control" required value="<?php if(isset($languageObject)) echo $languageObject->getISOCode(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="languageId" value="<?php echo $idLanguage; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>   
                    </div>
                        <input type="submit" value="<?php echo ($action === 'create') ? 'Crear' : 'Editar' ?>" class="btn btn-primary" name="buttonCreateEdit"/>
                    </form>
                </div>
            </div>

            <?php 
               } else {
                    if ($action === 'create') {
                        if ($languageCreated) {
                            MessageHTML::showMessage('Idioma creada correctamente.', true, 'list.php', 'Volver al listado de plataformas');
                        } else {
                            MessageHTML::showMessage('El idioma no se ha creado correctamente.', false, 'createEdit.php', 'Volver a intentarlo');
                        }
                    }
                    if ($action === 'edit') {
                        if ($languageEdited) {
                            MessageHTML::showMessage('Idioma editada correctamente.', true, 'list.php', 'Volver al listado de plataformas');
                        } else {
                            MessageHTML::showMessage('El idioma no se ha editado correctamente.', false, 'createEdit.php', 'Volver a intentarlo');
                        }
                    }
                }
                ?>
        </div>
    </body>
</html>
