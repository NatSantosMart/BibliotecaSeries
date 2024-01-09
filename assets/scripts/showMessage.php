<?php
class MessageHTML {
    public static function showMessage($message, $isSuccess, $redirectTo, $linkText) {
        $class = $isSuccess ? 'alert-success' : 'alert-danger';
        echo '<div class="container d-flex align-items-center justify-content-center vh-100">';
        echo '<div class="alert ' . $class . '" style="width: 600px; height: 100px; overflow-y: auto; text-align: center;">';
        echo '<p style="margin-top: 10px; margin-bottom: 10px;">' . $message . '</p>';
        echo '<a href="' . $redirectTo . '" style="margin-top: 10px; display: block;">' . $linkText . '</a>';
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
