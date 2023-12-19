<?php 
    require_once('../../controllers/PlatformController.php')
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <div class="row">
            <div class="col">
            <?php 
                $platformList = listPlatforms();
                if(count($platformList)> 0) {
             ?>
             <table class="table">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php 
                        foreach($platformList as $platform){
                    ?>   
                    <tr>
                        <td>
                            <?php echo $platform->getId(); ?>
                        </td>
                        <td>
                            <?php echo $platform->getName(); ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-succes" href="edit.php?id=<?php echo $platform->getId();?>">Editar</a>

                                <form name="delete_platform" action="delete.php" method="POST" style="...">
                                    <input type="hiden" name="platformId" value="<?php echo $platform->getId();?>"/>  
                                    <button type="submit" class="btn btn-danger">Borrar</button>

                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    
                </tbody>
                <?php
                        } else {   
               ?>
                <div class="alert alert-warning" role="alert">Aún no existen plataformas. </div>

                <?php 
                        }
                ?>
            
            </div>
        </div>
        
    </body>
</html>