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
        <div class="container">
            <?php
                 $sendData = false; 
                 $action = isset($_GET['action']) ? $_GET['action'] : 'create';

                //Editar plataforma
                if ($action === 'edit') {
                    $idPlatform = $_GET['id']; 
                    $platformObject = getPlatformData($idPlatform); 

                    $platformEdited = false;  
                    if(isset($_POST['buttonCreateEdit'])){ 
                        $sendData = true; 
                    }
                    if($sendData){
                        if(isset($_POST['platformName'])){
                            $platformEdited =  updatePlatform($_POST['platformId'], $_POST['platformName']); 
                        }
                    }
                } 
                //Crear plataforma
                else if ($action === 'create') {
                    $platformCreated = false;  
                    if(isset($_POST['buttonCreateEdit'])){ 
                        $sendData = true; 
                    }
                    if($sendData){
                        if(isset($_POST['platformName'])){
                            $platformCreated = storePlatform($_POST['platformName']); 
                        }
                    }
                }
                if(!$sendData) {

            ?>
    
            <div class="row">
                <div class="col-12">
                    <h1>Crear plataforma</h1>
                </div>
                <div class="col-12">
                    <form name="create_platform" action="" method="POST">
                        <div class="mb-3">
                            <label for="platformName" class="form-label">Nombre plataforma</label>
                            <input id="platformName" name="platformName" type="text" placeholder="Introduce el nombre de la plataforma" class="form-control" required value="<?php if(isset($platformObject)) echo $platformObject->getName(); ?>"/>
                            <?php 
                                if ($action === 'edit') {
                            ?>                           
                                <input type="hidden" name="platformId" value="<?php echo $idPlatform; ?>"/>
                            <?php 
                               }
                            ?>
                        </div>
                        <input type="submit" value="<?php echo ($action === 'create') ? 'Crear' : 'Editar' ?>" class="btn btn-primary" name="buttonCreateEdit"/>
                    </form>
                </div>
            </div>

            <?php 
               } else {
                    if ($action === 'create') {
                        if ($platformCreated) {
                            MessageHTML::showMessage('Plataforma creada correctamente.', true, 'list.php', 'Volver al listado de plataformas');
                        } else {
                            MessageHTML::showMessage('La plataforma no se ha creado correctamente.', false, 'createEdit.php', 'Volver a intentarlo');
                        }
                    }
                    if ($action === 'edit') {
                        if ($platformEdited) {
                            MessageHTML::showMessage('Plataforma editada correctamente.', true, 'list.php', 'Volver al listado de plataformas');
                        } else {
                            MessageHTML::showMessage('La plataforma no se ha editado correctamente.', false, 'createEdit.php', 'Volver a intentarlo');
                        }
                    }
                }
                ?>
        </div>
    </body>
</html>
