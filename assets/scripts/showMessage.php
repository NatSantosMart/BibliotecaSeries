<?php
class MessageHTML {
    public static function showSuccessMessage($message, $redirectTo, $linkText) {
        echo '<div class="container d-flex align-items-center justify-content-center vh-100">';
        echo '<div class="alert alert-success style="width: 600px; height: 150px; overflow-y: auto; display: flex; flex-direction: column; align-items: center;">';
        echo '<div style="margin-top: 10px;">';
        echo '<h5 style="display: inline-block; margin-right: 10px;">¡Enhorabuena!</h5>';
        echo '<p style="display: inline-block; margin-top: 10px; margin-bottom: 10px;">' . $message . '</p>';
        echo '</div>';
        echo '<a href="' . $redirectTo . '" style="margin-top: 10px; display: block;">' . $linkText . '</a>';
        echo '</div>';
        echo '</div>';
    }
    
    public static function showErrorMessage($message, $incorrectFields, $redirectTo, $linkText) {
        echo '<div class="container d-flex align-items-center justify-content-center vh-100">';
        echo '<div class="alert alert-danger style="width: 150px; height: 300px;">';
        echo '<h5 style="margin-top: 10px;">' . 'Error' . '</h5>';
        echo '<p style="margin-top: 10px;">' . $message . '<strong>' . $incorrectFields . '</strong></p>';
        echo '<a href="' . $redirectTo . '" style="margin-top: 10px;">' . $linkText . '</a>';
        echo '</div>';
        echo '</div>';
    }
    public static function showDeleteConfirmationModal($platformId, $titulo, $message) {
        echo '<div class="modal fade" id="confirmDeleteModal_' . $platformId . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo '<div class="modal-dialog" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="exampleModalLabel">' . $titulo .'</h5>';
        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<p>' . $message . 'Si acepta se eliminará permanentemente.' . '</p>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>';
        echo '<button type="button" class="btn btn-danger" onclick="deleteItem(' . $platformId . ')">Sí</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }  
}
?>
