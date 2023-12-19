<?php 
    require_once('../../controllers/PlatformController.php')
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="views/layouts/head.html" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title>Biblioteca</title>
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
                                <a class="btn btn-success" href="edit.php?id=<?php echo $platform->getId();?>">Editar</a>

                                <form name="delete_platform" action="delete.php" method="POST" style="...">
                                    <input type="hidden" name="platformId" value="<?php echo $platform->getId();?>"/>  
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