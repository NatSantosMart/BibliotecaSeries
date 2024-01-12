<?php

function validateDirectorFields($postData)
{
    $errors = array();
    $errorsEmptyFields = array();

    // Validate name
    if (empty($postData['directorName'])) {
        $errorsEmptyFields[] = 'nombre';
    } elseif (!preg_match('/^[A-Za-zÁ-Úá-ú\s]{1,100}$/', $postData['directorName'])) {
        $errors[] = 'nombre';
    }

    // Validate surnames
    if (empty($postData['directorSurnames'])) {
        $errorsEmptyFields[] = 'apellidos';
    } elseif (!preg_match('/^[A-Za-zÁ-Úá-ú\s]{1,200}$/', $postData['directorSurnames'])) {
        $errors[] = 'apellidos';
    }

    // Validate birthdate
    if (empty($postData['directorBirthdate'])) {
        $errorsEmptyFields[] = 'fecha de nacimiento';
    }

    // Validate nationality
    if (empty($postData['directorNationality'])) {
        $errorsEmptyFields[] = 'nacionalidad';
    } elseif (!preg_match('/^[A-Za-zÁ-Úá-ú\s]{1,30}$/', $postData['directorNationality'])) {
        $errors[] = 'nacionalidad';
    }

    $validationResult = array(
        'errors' => $errors,
        'errorsEmptyFields' => $errorsEmptyFields,
        'errorMessage' => '',
        'incorrectFields' => ''
    );

    if (!empty($errorsEmptyFields) || !empty($errors)) {
        $errorMessage = '';
        $incorrectFields = '';

        if (!empty($errorsEmptyFields)) {
            $errorMessage = $errorMessage . ' Todos los campos son obligatorios.';
        }
        if (!empty($errors)) {
            // If there are validation errors, display them
            if (count($errors) > 1) {
                $errorMessage = $errorMessage . ' Los siguientes campos tienen un formato incorrecto: ';
            } else {
                $errorMessage = $errorMessage . ' El siguiente campo tiene un formato incorrecto: ';
            }
            $incorrectFields = implode(', ', $errors);
        }

        $validationResult['errorMessage'] = $errorMessage;
        $validationResult['incorrectFields'] = $incorrectFields;
    }
    return $validationResult; 
}
?>
