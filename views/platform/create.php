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
                $platformCreated = false; 
                if(isset($_POST['createBtn'])){ //Si he hecho click en Crear
                    $sendData = true; 
                }
                if($sendData){
                    if(isset($_POST['platformName'])){
                        $platformCreated = storePlatform($_POST['platformName']); 
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
                            <input id="platformName" name="platformName" type="text" placeholder="Introduce el nombre de la plataforma" class="form-control" required/>
                        </div>
                        <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
                    </form>
                </div>
            </div>

            <?php 
               } else {
                    if ($platformCreated) {
                        MessageHTML::showMessage('Plataforma creada correctamente.', true, 'list.php', 'Volver al listado de plataformas');
                    } else {
                        MessageHTML::showMessage('La plataforma no se ha creado correctamente.', false, 'create.php', 'Volver a intentarlo');
                    }
                }
                ?>
        </div>
    </body>
</html>
