<?php 
    require_once('../../controllers/DirectorController.php'); 
    require_once('../../assets/scripts/showMessage.php');
    require_once('../../assets/scripts/validations.php'); 
?>
<!DOCTYPE html>
<html>
    <head>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="../../assets/scripts/shared.js"></script> 
        <script src="../../assets/scripts/validations.js"></script> 
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

                //Editar director
                if ($action === 'edit') {
                    $idDirector = $_GET['id']; 
                    $directorObject = getDirectorData($idDirector); 

                    $directorEdited = false;  
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
                                MessageHTML::showErrorMessage("El director no se ha editado correctamente." . $errorMessage, $incorrectFields, 'list.php', 'Volver al listado de directors');
                            }
                            else {
                                $directorEdited = updateDirector($idDirector, $_POST['itemName'], $_POST['itemSurnames'], $_POST['itemBirthdate'], $_POST['itemNationality']);
                            }               
                        }                        
                    }
                } 
                //Crear director
                else if ($action === 'create') {
                    $directorCreated = false;  
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
                                MessageHTML::showErrorMessage("El director no se ha creado correctamente." . $errorMessage, $incorrectFields, 'createEdit.php', 'Volver a intentarlo');
                            }
                            else {
                                $directorCreated = storeDirector($_POST['itemName'], $_POST['itemSurnames'], $_POST['itemBirthdate'], $_POST['itemNationality']); 
                            }               
                        }                        
                    }
                }
                if(!$sendData) {

            ?>
    
            <div class="row">
                <div class="col-12">
                    <?php 
                        if ($action === 'create'){
                    ?>
                        <h1>Crear director</h1>
                    <?php 
                        } else {
                    ?>                    
                    <h1>Editar director</h1> 
                    <?php 
                        }
                    ?>
                </div>
                <div class="col-12">
                    <form name="create_director" action="" method="POST">

                    <div class="row">
                        <div class="col-6">
                            <label for="itemName" class="form-label">Nombre: </label>
                            <input id="itemName" name="itemName" type="text" placeholder="Introduce el nombre" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getName(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="directorId" value="<?php echo $idDirector; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>
                        <div class="col-6">
                            <label for="itemSurnames" class="form-label">Apellidos:</label>
                            <input id="itemSurnames" name="itemSurnames" type="text" placeholder="Introduce los apellidos" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getSurnames(); ?>"/>
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="itemBirthdate" class="form-label">Fecha nacimiento: </label>
                            <input id="itemBirthdate" name="itemBirthdate" type="date" placeholder="Introduce la fecha de nacimiento" required class="form-control" value="<?php if(isset($directorObject)) echo $directorObject->getBirthdate(); ?>"/>
                        </div>
                        <div class="col-6">
                            <label for="itemNationality" class="form-label">Nacionalidad:</label>
                            <input id="itemNationality" name="itemNationality" type="text" placeholder="Introduce la nacionalidad" required class="form-control" value="<?php if(isset($directorObject)) echo $directorObject->getNationality(); ?>"/>
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
                        if ($directorCreated) {
                            MessageHTML::showSuccessMessage('Director creado correctamente.', 'list.php', 'Volver al listado de directors');
                        }
                    }
                    if ($action === 'edit') {
                        if ($directorEdited) {
                            MessageHTML::showSuccessMessage('Director editado correctamente.', 'list.php', 'Volver al listado de directors');
                        }
                    }
                }
                ?>
        </div>
    </body>
</html>
