<?php
//Require database in this file & image helpers
/** @var mysqli $db */
require_once "includes/database.php";


//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $klantId = mysqli_escape_string($db, $_POST['id']);
    $voornaam = mysqli_escape_string($db, $_POST['voornaam']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $achternaam = mysqli_escape_string($db, $_POST['achternaam']);
    $telefoonnummer = mysqli_escape_string($db, $_POST['telefoonnummer']);

    //Require the form validation handling
    require_once "includes/form-validation.php";

    //Save variables to array so the form won't break
    //This array is build the same way as the db result
    $klant = [
        'voornaam' => $voornaam,
        'email' => $email,
        'achternaam' => $achternaam,
        'telefoonnummer' => $telefoonnummer,
    ];

    if (empty($errors)) {

        //Update the record in the database
        $query = "UPDATE klanten
                  SET voornaam = '$voornaam', email = '$email', achternaam = '$achternaam', telefoonnummer = '$telefoonnummer'
                  WHERE id = '$klantId'";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
} else if (isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $klantId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM klanten WHERE id = " . mysqli_escape_string($db, $klantId);
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $klant = mysqli_fetch_assoc($result);
    } else {
        // redirect when db returns no result
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Klant Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Edit "<?= $klant['voornaam'] . ' - ' . $klant['achternaam'] ?>"</h1>


<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="voornaam">Voornaam</label><p></p>
        <input id="voornaam" type="text" name="voornaam" value="<?= htmlentities($klant['voornaam']) ?>"/>
        <span class="errors"><?= isset($errors['voornaam']) ? $errors['voornaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="achternaam">Achternaam</label><p></p>
        <input id="achternaam" type="text" name="achternaam" value="<?= htmlentities($klant['achternaam']) ?>"/>
        <span class="errors"><?= isset($errors['achternaam']) ? $errors['achternaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="email">E-mail</label><p></p>
        <input id="email" type="text" name="email" value="<?= htmlentities($klant['email']) ?>"/>
        <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="telefoonnummer">Telefoonnummer</label><p></p>
        <input id="telefoonnummer" type="number" name="telefoonnummer" value="<?= htmlentities($klant['telefoonnummer']) ?>"/>
        <span class="errors"><?= isset($errors['telefoonnummer']) ? $errors['telefoonnummer'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $klantId ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Ga terug naar de lijst</a>
</div>
</body>
</html>
