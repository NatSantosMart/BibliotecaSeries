<?php
    require_once('../../controllers/LanguageController.php');
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
            <h1>Listado de idiomas</h1>
        </div>
        <div class="row">
            <a class="btn btn-primary" href="createEdit.php?action=create" role="button">
                <i class="fas fa-plus"></i> Crear idioma
            </a>
        </div>
        <div class="row">
            <div class="col">
                <?php 
                    $languageList = listLanguages();
                    if(count($languageList) > 0) {
                ?>
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Código ISO</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($languageList as $language){
                        ?>   
                        <tr>
                            <td>
                                <?php echo $language->getId(); ?>
                            </td>
                            <td>
                                <?php echo $language->getName(); ?>
                            </td>
                            <td>
                                <?php echo $language->getISOCode(); ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-success mr-2" href="createEdit.php?action=edit&id=<?php echo $language->getId();?>">Editar</a>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal_<?php echo $language->getId(); ?>">
                                        Borrar
                                    </button>
                                    
                                 <?php 
                                     MessageHTML::showDeleteConfirmationModal($language->getId(), 'Eliminar idioma', '¿Estás seguro de eliminar el idioma? ');
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
                <div class="alert alert-warning" role="alert">Aún no existen idiomas.</div>
                <?php 
                    }       
                ?>
            </div>
        </div>
    </div>

    <script>
        function deleteItem(languageId) {
            window.location.href = 'delete.php?languageId=' + languageId;
        }
    </script>
</body>
</html>
