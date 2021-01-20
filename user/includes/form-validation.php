<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($gebruikersnaam == "") {
    $errors['gebruikersnaam'] = 'Veld Gebruikersnaam mag niet leeg zijn';
}
if ($wachtwoord == "") {
    $errors['wachtwoord'] = 'Veld Wachtwoord mag niet leeg zijn';
}
if ($is_admin == "") {
    $errors['is_admin'] = 'Veld Admin mag niet leeg zijn';
}
