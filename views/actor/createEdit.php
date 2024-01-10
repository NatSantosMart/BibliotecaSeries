<?php 
    require_once('../../controllers/ActorController.php'); 
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

                //Editar actor
                if ($action === 'edit') {
                    $idActor = $_GET['id']; 
                    $actorObject = getActorData($idActor); 

                    $actorEdited = false;  
                    if(isset($_POST['buttonCreateEdit'])){ 
                        $sendData = true; 
                    }
                    if($sendData){
                        if(isset($_POST['actorName'])){
                            $actorEdited =  updateActor($_POST['actorId'], $_POST['actorName'], $_POST['actorSurnames'], $_POST['actorBirthdate'], $_POST['actorNationality']); 
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
                        if(isset($_POST['actorName'])){
                            $actorCreated = storeActor($_POST['actorName'], $_POST['actorSurnames'], $_POST['actorBirthdate'], $_POST['actorNationality']); 
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
                            <label for="actorName" class="form-label">Nombre: </label>
                            <input id="actorName" name="actorName" type="text" placeholder="Introduce el nombre" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getName(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="actorId" value="<?php echo $idActor; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>
                        <div class="col-6">
                            <label for="actorSurnames" class="form-label">Apellidos:</label>
                            <input id="actorSurnames" name="actorSurnames" type="text" placeholder="Introduce los apellidos" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getSurnames(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="actorId" value="<?php echo $idActor; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="actorBirthdate" class="form-label">Fecha nacimiento: </label>
                            <input id="actorBirthdate" name="actorBirthdate" type="date" placeholder="Introduce la fecha de nacimiento" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getBirthdate(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="actorId" value="<?php echo $idActor; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>
                        <div class="col-6">
                            <label for="actorNationality" class="form-label">Nacionalidad:</label>
                            <input id="actorNationality" name="actorNationality" type="text" placeholder="Introduce la nacionalidad" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getNationality(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="actorId" value="<?php echo $idActor; ?>"/>
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
                            MessageHTML::showMessage('Actor creada correctamente.', true, 'list.php', 'Volver al listado de actors');
                        } else {
                            MessageHTML::showMessage('La actor no se ha creado correctamente.', false, 'createEdit.php', 'Volver a intentarlo');
                        }
                    }
                    if ($action === 'edit') {
                        if ($actorEdited) {
                            MessageHTML::showMessage('Actor editada correctamente.', true, 'list.php', 'Volver al listado de actors');
                        } else {
                            MessageHTML::showMessage('La actor no se ha editado correctamente.', false, 'createEdit.php', 'Volver a intentarlo');
                        }
                    }
                }
                ?>
        </div>
    </body>
</html>
