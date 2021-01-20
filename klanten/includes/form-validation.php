<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($voornaam == "") {
    $errors['voornaam'] = 'Veld Voornaam mag niet leeg zijn';
}
if ($achternaam == "") {
    $errors['achternaam'] = 'Veld Achternaam mag niet leeg zijn';
}
if ($telefoonnummer == "") {
    $errors['telefoonnummer'] = 'Veld Telefoonnummer mag niet leeg zijn';
}
