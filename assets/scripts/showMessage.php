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
}
?>
