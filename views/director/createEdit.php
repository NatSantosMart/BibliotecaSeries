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

                //Editar director
                if ($action === 'edit') {
                    $idDirector = $_GET['id']; 
                    $directorObject = getDirectorData($idDirector); 

                    $directorEdited = false;  
                    if(isset($_POST['buttonCreateEdit'])){ 
                        $sendData = true; 
                    }
                    if($sendData){
                        if (isset($_POST['directorName'])) {
                            $validationResult = validateDirectorFields($_POST);

                            $errors = $validationResult['errors'];
                            $errorsEmptyFields = $validationResult['errorsEmptyFields'];
                            $errorMessage = $validationResult['errorMessage'];
                            $incorrectFields = $validationResult['incorrectFields'];
                        
                            if (!empty($errorsEmptyFields) || !empty($errors)) {
                                MessageHTML::showMessageError("El director no se ha creado correctamente." . $errorMessage, $incorrectFields, false, 'list.php', 'Volver al listado de directors');
                            }
                            else {
                                $directorEdited = updateDirector($idDirector, $_POST['directorName'], $_POST['directorSurnames'], $_POST['directorBirthdate'], $_POST['directorNationality']);
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
                        if (isset($_POST['directorName'])) {
                            $validationResult = validateDirectorFields($_POST);

                            $errors = $validationResult['errors'];
                            $errorsEmptyFields = $validationResult['errorsEmptyFields'];
                            $errorMessage = $validationResult['errorMessage'];
                            $incorrectFields = $validationResult['incorrectFields'];
                        
                            if (!empty($errorsEmptyFields) || !empty($errors)) {
                                MessageHTML::showMessageError("El director no se ha creado correctamente." . $errorMessage, $incorrectFields, false, 'list.php', 'Volver al listado de directors');
                            }
                            else {
                                $directorCreated = storeDirector($_POST['directorName'], $_POST['directorSurnames'], $_POST['directorBirthdate'], $_POST['directorNationality']); 
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
                            <label for="directorName" class="form-label">Nombre: </label>
                            <input id="directorName" name="directorName" type="text" placeholder="Introduce el nombre" class="form-control" value="<?php if(isset($directorObject)) echo $directorObject->getName(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="directorId" value="<?php echo $idDirector; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>
                        <div class="col-6">
                            <label for="directorSurnames" class="form-label">Apellidos:</label>
                            <input id="directorSurnames" name="directorSurnames" type="text" placeholder="Introduce los apellidos" class="form-control" value="<?php if(isset($directorObject)) echo $directorObject->getSurnames(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="directorId" value="<?php echo $idDirector; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="directorBirthdate" class="form-label">Fecha nacimiento: </label>
                            <input id="directorBirthdate" name="directorBirthdate" type="date" placeholder="Introduce la fecha de nacimiento" class="form-control" value="<?php if(isset($directorObject)) echo $directorObject->getBirthdate(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="directorId" value="<?php echo $idDirector; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>
                        <div class="col-6">
                            <label for="directorNationality" class="form-label">Nacionalidad:</label>
                            <input id="directorNationality" name="directorNationality" type="text" placeholder="Introduce la nacionalidad" class="form-control" value="<?php if(isset($directorObject)) echo $directorObject->getNationality(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="directorId" value="<?php echo $idDirector; ?>"/>
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
                        if ($directorCreated) {
                            MessageHTML::showMessage('Director creado correctamente.', true, 'list.php', 'Volver al listado de directors');
                        } else {
                            MessageHTML::showMessage('La director no se ha creado correctamente.', false, 'createEdit.php', 'Volver a intentarlo');
                        }
                    }
                    if ($action === 'edit') {
                        if ($directorEdited) {
                            MessageHTML::showMessage('Director editado correctamente.', true, 'list.php', 'Volver al listado de directors');
                        } else {
                            MessageHTML::showMessage('La director no se ha editado correctamente.', false, 'createEdit.php', 'Volver a intentarlo');
                        }
                    }
                }
                ?>
        </div>
    </body>
</html>
