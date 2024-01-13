<?php
require_once('../../controllers/SeriesController.php');
require_once('../../assets/scripts/showMessage.php');
require_once('../../assets/scripts/validations.php');
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

    label {
        margin-top: 10px;
    }
</style>

<body>
    <div class="container">
        <?php
        $sendData = false;
        $action = isset($_GET['action']) ? $_GET['action'] : 'create';
        $fieldsToValidate = ['itemTitle', 'itemPlatformId', 'itemDirectorId'];

        // Editar serie
        if ($action === 'edit') {
            $idSeries = $_GET['id'];
            $seriesObject = getSeriesData($idSeries);

            $seriesEdited = false;
            if (isset($_POST['buttonCreateEdit'])) {
                $sendData = true;
            }
            if ($sendData) {
                if (isset($_POST['itemTitle'])) {
                    $validationResult = validateFields($_POST, $fieldsToValidate);

                    $errors = $validationResult['errors'];
                    $errorsEmptyFields = $validationResult['errorsEmptyFields'];
                    $errorMessage = $validationResult['errorMessage'];
                    $incorrectFields = $validationResult['incorrectFields'];

                    if (!empty($errorsEmptyFields) || !empty($errors)) {
                        MessageHTML::showErrorMessage("La serie no se ha editado correctamente." . $errorMessage, $incorrectFields, 'list.php', 'Volver al listado de series');
                    } else {
                        $seriesEdited = updateSeries($_POST['itemId'], $_POST['itemTitle'], $_POST['itemPlatformId'], $_POST['itemDirectorId']);
                    }
                }
            }
        }
        // Crear serie
        else if ($action === 'create') {
            $seriesCreated = false;
            if (isset($_POST['buttonCreateEdit'])) {
                $sendData = true;
            }
            if ($sendData) {
                if (isset($_POST['itemTitle'])) {
                    $validationResult = validateFields($_POST, $fieldsToValidate);

                    $errors = $validationResult['errors'];
                    $errorsEmptyFields = $validationResult['errorsEmptyFields'];
                    $errorMessage = $validationResult['errorMessage'];
                    $incorrectFields = $validationResult['incorrectFields'];

                    if (!empty($errorsEmptyFields) || !empty($errors)) {
                        MessageHTML::showErrorMessage("La serie no se ha creado correctamente." . $errorMessage, $incorrectFields, 'list.php', 'Volver al listado de series');
                    } else {
                        $seriesCreated = storeSeries($_POST['itemTitle'], $_POST['itemPlatformId'], $_POST['itemDirectorId'], $actors,
                        $languagesAudio,
                        $languagesSubtitles);
                    }
                }
            }
        }
        if (!$sendData) {
        ?>

            <div class="row">
                <div class="col-12">
                    <h1><?php echo ($action === 'create') ? 'Crear serie' : 'Editar serie'; ?></h1>
                </div>
                <div class="col-12">
                    <form name="create_series" action="" method="POST">

                        <div class="row">
                            <div class="col-6">
                                <label for="itemTitle" class="form-label">Título: </label>
                                <input id="itemTitle" name="itemTitle" type="text" placeholder="Introduce el título" class="form-control" required value="<?php if (isset($seriesObject)) echo $seriesObject->getTitle(); ?>" />
                                <?php
                                if ($action === 'edit') {
                                ?>
                                    <input type="hidden" name="itemId" value="<?php echo $idSeries; ?>" />
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-6">
                                <label for="itemPlatformId" class="form-label">Plataforma:</label>
                                <select id="itemPlatformId" name="itemPlatformId" class="form-control" required>
                                    <!-- Revisar que se cogen bien los datos de la bd-->
                                    <?php
                                    $platformsList = listPlatforms();
                                    foreach ($platformsList as $platform) {
                                        $selected = (isset($seriesObject) && $seriesObject->getPlatformId() == $platform->getId()) ? 'selected' : '';
                                        echo "<option value='{$platform->getId()}' {$selected}>{$platform->getName()}</option>";
                                    }
                                    ?>
                                </select>
                                <?php
                                if ($action === 'edit') {
                                ?>
                                    <input type="hidden" name="itemId" value="<?php echo $idSeries; ?>" />
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="itemDirectorId" class="form-label">Director: </label>
                                <select id="itemDirectorId" name="itemDirectorId" class="form-control" required>
                                    <!-- Revisar que se cogen bien los datos de la bd-->
                                    <?php
                                    $directorsList = listDirectors();
                                    foreach ($directorsList as $director) {
                                        $selected = (isset($seriesObject) && $seriesObject->getDirectorId() == $director->getId()) ? 'selected' : '';
                                        echo "<option value='{$director->getId()}' {$selected}>{$director->getName()} {$director->getSurnames()}</option>";
                                    }
                                    ?>
                                </select>
                                <?php
                                if ($action === 'edit') {
                                ?>
                                    <input type="hidden" name="itemId" value="<?php echo $idSeries; ?>" />
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" style="margin-left: 15px;" value="<?php echo ($action === 'create') ? 'Crear' : 'Editar' ?>" class="btn btn-primary" name="buttonCreateEdit" />
                        </div>
                    </form>
                </div>
            </div>

        <?php
        } else {
            if ($action === 'create') {
                if ($seriesCreated) {
                    MessageHTML::showSuccessMessage('Serie creada correctamente.', 'list.php', 'Volver al listado de series');
                }
            }
            if ($action === 'edit') {
                if ($seriesEdited) {
                    MessageHTML::showSuccessMessage('Serie editada correctamente.', 'list.php', 'Volver al listado de series');
                }
            }
        }
        ?>
    </div>
</body>

</html>
