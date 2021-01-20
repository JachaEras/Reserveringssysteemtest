<?php
session_start();

$email = '';
$password = '';

//If our session doesn't exist, redirect & exit script
if (isset($_SESSION['loggedInUser'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    /** @var mysqli $db */
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = $_POST['password'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $telefoonnummer = $_POST['telefoonnummer'];

    $errors = [];
    if ($email == '') {
        $errors['email'] = 'The email cannot be empty';
    }
    if ($password == '') {
        $errors['password'] = 'The password cannot be empty';
    }
    if ($voornaam == '') {
        $errors['voornaam'] = 'The password cannot be empty';
    }
    if ($achternaam == '') {
        $errors['achternaam'] = 'The password cannot be empty';
    }
    if ($telefoonnummer == '') {
        $errors['telefoonnummer'] = 'The password cannot be empty';
    }

    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO klanten (email, password, voornaam, achternaam, telefoonnummer) VALUE('$email', '$password', '$voornaam', '$achternaam', '$telefoonnummer')";
        $result = mysqli_query($db, $query)
        or die('Error: ' . $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>Nieuwe gebruiker registeren</h2>
<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="<?= $email ?>"/>
        <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="password">Password</label>
        <input id="password" type="password" name="password"/>
        <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="voornaam">voornaam</label>
        <input id="voornaam" type="text" name="voornaam"/>
        <span class="errors"><?= isset($errors['voornaam']) ? $errors['voornaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="achternaam">achternaam</label>
        <input id="achternaam" type="text" name="achternaam"/>
        <span class="errors"><?= isset($errors['achternaam']) ? $errors['achternaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="telefoonnummer">telefoonnummer</label>
        <input id="telefoonnummer" type="text" name="telefoonnummer"/>
        <span class="errors"><?= isset($errors['telefoonnummer']) ? $errors['telefoonnummer'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
</body>
</html>
