<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($datum == "") {
    $errors['datum'] = 'Veld Datum mag niet leeg zijn';
}
if ($decoratie== "") {
    $errors['decoratie'] = 'Veld Decoratie mag niet leeg zijn';
}
if ($soort_evenement == "") {
    $errors['soort_evenement'] = 'Veld Soort_evenement mag niet leeg zijn';
}
if ($locatie_evenement == "") {
    $errors['locatie_evenement'] = 'Veld Locatie_evenement mag niet leeg zijn';
}
