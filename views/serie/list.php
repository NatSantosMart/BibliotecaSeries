<?php
    require_once('../../controllers/SerieController.php');
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
            <h1>Listado de series</h1>
        </div>
        <div class="row">
            <a class="btn btn-primary" href="createEdit.php?action=create" role="button">
                <i class="fas fa-plus"></i> Crear serie
            </a>
        </div>
        <div class="row">
            <div class="col">
                <?php 
                    $seriesList = listSeries();
                    if(count($seriesList) > 0) {
                ?>
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Plataforma</th>
                        <th>Director</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($seriesList as $serie){
                        ?>   
                        <tr>
                            <td>
                                <?php echo $serie->getId(); ?>
                            </td>
                            <td>
                                <?php echo $serie->getTitle(); ?>
                            </td>
                            <td>
                                <?php echo $serie->getPlatformId(); ?>
                            </td>
                            <td>
                                <?php echo $serie->getDirectorId(); ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-success mr-2" href="createEdit.php?action=edit&id=<?php echo $serie->getId();?>">Editar</a>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal_<?php echo $serie->getId(); ?>">
                                        Borrar
                                    </button>
                                    
                                 <?php 
                                     MessageHTML::showDeleteConfirmationModal($serie->getId(), 'Eliminar serie', '¿Estás seguro de eliminar la serie? ');
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
                <div class="alert alert-warning" role="alert">Aún no existen series.</div>
                <?php 
                    }       
                ?>
            </div>
        </div>
    </div>

    <script>
        function deleteItem(seriesId) {
            window.location.href = 'delete.php?seriesId=' + seriesId;
        }
    </script>
</body>
</html>
