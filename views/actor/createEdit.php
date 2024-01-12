<?php 
    require_once('../../controllers/ActorController.php'); 
    require_once('../../assets/scripts/showMessage.php');
    require_once('../../assets/scripts/validations.php'); 
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
                 $fieldsToValidate = ['itemName', 'itemSurnames', 'itemBirthdate', 'itemNationality'];

                //Editar actor
                if ($action === 'edit') {
                    $idActor = $_GET['id']; 
                    $actorObject = getActorData($idActor); 

                    $actorEdited = false;  
                    if(isset($_POST['buttonCreateEdit'])){ 
                        $sendData = true; 
                    }
                    if($sendData){
                        if (isset($_POST['itemName'])) {
                            $validationResult = validateFields($_POST, $fieldsToValidate);

                            $errors = $validationResult['errors'];
                            $errorsEmptyFields = $validationResult['errorsEmptyFields'];
                            $errorMessage = $validationResult['errorMessage'];
                            $incorrectFields = $validationResult['incorrectFields'];
                        
                            if (!empty($errorsEmptyFields) || !empty($errors)) {
                                MessageHTML::showErrorMessage("El actor no se ha editado correctamente." . $errorMessage, $incorrectFields, 'list.php', 'Volver al listado de directors');
                            }
                            else {
                                $actorEdited =  updateActor($_POST['itemId'], $_POST['itemName'], $_POST['itemSurnames'], $_POST['itemBirthdate'], $_POST['itemNationality']); 
                            }               
                        }                        
                    }
                } 
                //Crear actor
                else if ($action === 'create') {
                    $actorCreated = false;  
                    if(isset($_POST['buttonCreateEdit'])){ 
                        $sendData = true; 
                    }
                    if($sendData){
                        if (isset($_POST['itemName'])) {
                            $validationResult = validateFields($_POST, $fieldsToValidate);

                            $errors = $validationResult['errors'];
                            $errorsEmptyFields = $validationResult['errorsEmptyFields'];
                            $errorMessage = $validationResult['errorMessage'];
                            $incorrectFields = $validationResult['incorrectFields'];
                        
                            if (!empty($errorsEmptyFields) || !empty($errors)) {
                                MessageHTML::showErrorMessage("El actor no se ha creado correctamente." . $errorMessage, $incorrectFields, 'list.php', 'Volver al listado de directors');
                            }
                            else {
                                $actorCreated = storeActor($_POST['itemName'], $_POST['itemSurnames'], $_POST['itemBirthdate'], $_POST['itemNationality']); 
                            }               
                        }                        
                    }
                    
                }
                if(!$sendData) {

            ?>
    
            <div class="row">
                <div class="col-12">
                    <h1>Crear actor</h1>
                </div>
                <div class="col-12">
                    <form name="create_actor" action="" method="POST">

                    <div class="row">
                        <div class="col-6">
                            <label for="itemName" class="form-label">Nombre: </label>
                            <input id="itemName" name="itemName" type="text" placeholder="Introduce el nombre" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getName(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="itemId" value="<?php echo $idActor; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>
                        <div class="col-6">
                            <label for="itemSurnames" class="form-label">Apellidos:</label>
                            <input id="itemSurnames" name="itemSurnames" type="text" placeholder="Introduce los apellidos" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getSurnames(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="itemId" value="<?php echo $idActor; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="itemBirthdate" class="form-label">Fecha nacimiento: </label>
                            <input id="itemBirthdate" name="itemBirthdate" type="date" placeholder="Introduce la fecha de nacimiento" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getBirthdate(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="itemId" value="<?php echo $idActor; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>
                        <div class="col-6">
                            <label for="itemNationality" class="form-label">Nacionalidad:</label>
                            <input id="itemNationality" name="itemNationality" type="text" placeholder="Introduce la nacionalidad" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getNationality(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="itemId" value="<?php echo $idActor; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>                     
                    </div>
                    <div class="row">
                        <input type="submit" style="margin-left: 15px;" value="<?php echo ($action === 'create') ? 'Crear' : 'Editar' ?>" class="btn btn-primary" name="buttonCreateEdit"/>
                    </div>
                </form>
            </div>
        </div>

            <?php 
               } else {
                    if ($action === 'create') {
                        if ($actorCreated) {
                            MessageHTML::showSuccessMessage('Actor creado correctamente.', 'list.php', 'Volver al listado de actors');
                        }
                    }
                    if ($action === 'edit') {
                        if ($actorEdited) {
                            MessageHTML::showSuccessMessage('Actor editado correctamente.', 'list.php', 'Volver al listado de actors');
                        }
                    }
                }
                ?>
        </div>
    </body>
</html>
