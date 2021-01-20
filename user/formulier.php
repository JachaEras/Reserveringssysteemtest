
<?php
//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $gebruikersnaam  = mysqli_escape_string($db, $_POST['gebruikersnaam']);
    $wachtwoord = mysqli_escape_string($db, $_POST['wachtwoord']);
    $is_admin  = mysqli_escape_string($db, $_POST['is_admin']);


    //Require the form validation handling
    require_once "includes/form-validation.php";

    //Special check for add form only


    if (empty($errors)) {

        //Save the record to the database
        $query = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord, is_admin)
                  VALUES ('$gebruikersnaam', '$wachtwoord', '$is_admin')";
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
    <title>Creeer Gebruiker</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Creeer Gebruiker</h1>

<!-- enctype="multipart/form-data" no characters will be converted -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="gebruikersnaam">Gebruikersnaam</label><p></p>
        <input id="gebruikersnaam" type="text" name="gebruikersnaam" value="<?= isset($gebruikersnaam) ? htmlentities($gebruikersnaam) : '' ?>"/>
        <span class="errors"><?= isset($errors['gebruikersnaam']) ? $errors['gebruikersnaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="wachtwoord">Wachtwoord</label><p></p>
        <input id="wachtwoord" type="text" name="wachtwoord" value="<?= isset($achternaam) ? htmlentities($achternaam) : '' ?>"/>
        <span class="errors"><?= isset($errors['wachtwoord']) ? $errors['wachtwoord'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="is_admin">Admin ja/nee</label><p></p>
        <input id="is_admin" type="text" name="is_admin" value="<?= isset($is_admin) ? htmlentities($is_admin) : '' ?>"/>
        <span class="errors"><?= isset($errors['is_admin']) ? $errors['is_admin'] : '' ?></span>
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
