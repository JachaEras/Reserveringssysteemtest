
<?php
//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $voornaam  = mysqli_escape_string($db, $_POST['voornaam']);
    $achternaam = mysqli_escape_string($db, $_POST['achternaam']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $telefoonnummer = mysqli_escape_string($db, $_POST['telefoonnummer']);



    //Require the form validation handling
    require_once "includes/form-validation.php";

    //Special check for add form only


    if (empty($errors)) {

        //Save the record to the database
        $query = "INSERT INTO klanten (voornaam, achternaam, email, telefoonnummer)
                  VALUES ('$voornaam', '$achternaam', '$email', '$telefoonnummer')";
        $result = mysqli_query($db, $query)
        or die('Error: '.$query);

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
    <title>Klant creeeren</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Creeer klant</h1>

<!-- enctype="multipart/form-data" no characters will be converted -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="voornaam">Voornaam</label><p></p>
        <input id="voornaam" type="text" name="voornaam" value="<?= isset($voornaam) ? htmlentities($voornaam) : '' ?>"/>
        <span class="errors"><?= isset($errors['voornaam']) ? $errors['voornaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="achternaam">Achternaam</label><p></p>
        <input id="achternaam" type="text" name="achternaam" value="<?= isset($achternaam) ? htmlentities($achternaam) : '' ?>"/>
        <span class="errors"><?= isset($errors['achternaam']) ? $errors['achternaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="email">email</label><p></p>
        <input id="email" type="text" name="email" value="<?= isset($email) ? htmlentities($email) : '' ?>"/>
        <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="telefoonnummer">Telefoonnummer</label><p></p>
        <input id="telefoonnummer" type="number" name="telefoonnummer" value="<?= isset($telefoonnummer) ? htmlentities($telefoonnummer) : '' ?>"/>
        <span class="errors"><?= isset($errors['telefoonnummer']) ? $errors['telefoonnummer'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Ga terug naar de lijst</a>
</div>
</body>
</html>
