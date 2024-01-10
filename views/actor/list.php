<?php
    require_once('../../controllers/ActorController.php');
    require_once('../../assets/scripts/showMessage.php');
?>

<!DOCTYPE html>
<html>
<head>
    <script src="../../assets/scripts/shared.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<style>
    .row {
        margin-top: 15px;    
    }  
</style>

<body>
    <div class="container">
        <div class="row">
            <h1>Listado de actores</h1>
        </div>
        <div class="row">
            <a class="btn btn-primary" href="createEdit.php?action=create" role="button">
                <i class="fas fa-plus"></i> Crear actor
            </a>
        </div>
        <div class="row">
            <div class="col">
                <?php 
                    $actorList = listActors();
                    if(count($actorList) > 0) {
                ?>
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Fecha nacimiento</th>
                        <th>Nacionalidad</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($actorList as $actor){
                        ?>   
                        <tr>
                            <td>
                                <?php echo $actor->getId(); ?>
                            </td>
                            <td>
                                <?php echo $actor->getName(); ?>
                            </td>
                            <td>
                                <?php echo $actor->getSurnames(); ?>
                            </td>
                            <td>
                                <?php echo date('d/m/Y', strtotime($actor->getBirthdate())); ?>
                            </td>
                            <td>
                                <?php echo $actor->getNationality(); ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-success mr-2" href="createEdit.php?action=edit&id=<?php echo $actor->getId();?>">Editar</a>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal_<?php echo $actor->getId(); ?>">
                                        Borrar
                                    </button>
                                    
                                 <?php 
                                     MessageHTML::showDeleteConfirmationModal($actor->getId(), 'Eliminar actor', '¿Estás seguro de eliminar el actor? ');
                                 ?>                         
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                    } else {   
                ?>
                <div class="alert alert-warning" role="alert">Aún no existen actores.</div>
                <?php 
                    }       
                ?>
            </div>
        </div>
    </div>

    <script>
        function deleteItem(actorId) {
            window.location.href = 'delete.php?actorId=' + actorId;
        }
    </script>
</body>
</html>
