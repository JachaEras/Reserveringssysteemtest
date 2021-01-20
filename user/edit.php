<?php
//Require database in this file & image helpers
/** @var mysqli $db */
require_once "includes/database.php";


//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $gebruikerId = mysqli_escape_string($db, $_POST['id']);
    $gebruikersnaam = mysqli_escape_string($db, $_POST['gebruikersnaam']);
    $wachtwoord = mysqli_escape_string($db, $_POST['wachtwoord']);
    $is_admin = mysqli_escape_string($db, $_POST['is_admin']);


    //Require the form validation handling
    require_once "includes/form-validation.php";

    //Save variables to array so the form won't break
    //This array is build the same way as the db result
    $gebruiker = [
        'gebruikersnaam' => $gebruikersnaam,
        'wachtwoord' => $wachtwoord,
        'is_admin' => $is_admin,
    ];

    if (empty($errors)) {

        //Update the record in the database
        $query = "UPDATE gebruikers
                  SET gebruikersnaam = '$gebruikersnaam', wachtwoord = '$wachtwoord', is_admin = '$is_admin'
                  WHERE id = '$gebruikerId'";
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
    $gebruikerId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM gebruikers WHERE id = " . mysqli_escape_string($db, $gebruikerId);
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $gebruiker = mysqli_fetch_assoc($result);
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
    <title>Gebruiker Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Edit "<?= $gebruiker['gebruikersnaam'] . ' - ' . $gebruiker['wachtwoord'] ?>"</h1>


<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="gebruikersnaam">Gebruikersnaam</label><p></p>
        <input id="gebruikersnaam" type="text" name="gebruikersnaam" value="<?= htmlentities($gebruiker['gebruikersnaam']) ?>"/>
        <span class="errors"><?= isset($errors['gebruikersnaam']) ? $errors['gebruikersnaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="wachtwoord">Wachtwoord</label><p></p>
        <input id="wachtwoord" type="text" name="wachtwoord" value="<?= htmlentities($gebruiker['wachtwoord']) ?>"/>
        <span class="errors"><?= isset($errors['wachtwoord']) ? $errors['wachtwoord'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="is_admin">Admin ja/nee</label><p></p>
        <input id="is_admin" type="text" name="is_admin" value="<?= htmlentities($gebruiker['is_admin']) ?>"/>
        <span class="errors"><?= isset($errors['is_admin']) ? $errors['is_admin'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $gebruikerId ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Ga terug naar de lijst</a>
</div>
</body>
</html>
