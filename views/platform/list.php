<?php 
    require_once('../../controllers/PlatformController.php')
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="../../assets/scripts/shared.js"></script> 
    </head>
    <style>
        .row {
            margin-top: 15px;    
        }  
        
    </style>

    <body>
        <div class="container">
            <div class="row">
                <h1>Listado de plataformas</h1>
            </div>
            <div class="row">
                <a class="btn btn-primary" href="createEdit.php?action=create" role="button">
                    <i class="fas fa-plus"></i> Crear plataforma
                </a>
            </div>
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
                                    <a class="btn btn-success mr-2" href="createEdit.php?action=edit&id=<?php echo $platform->getId();?>">Editar</a>
                          
                                    <form name="delete_platform" action="delete.php" method="POST" style="...">
                                        <input type="hidden" name="platformId" value="<?php echo $platform->getId();?>"/>  
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                    </form>
                                </div>

                                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar plataforma</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Está seguro de eliminar la plataforma? Si pulsa acepta se eliminará permanentemente.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="button" class="btn btn-danger" onclick="submitDeleteForm()">Sí</button>
                                            </div>
                                        </div>
                                    </div>
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
         </div>
    </body>
</html>