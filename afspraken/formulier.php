<?php
/**
 * @var mysqli $db
 * @var array $klanten
 */
session_start();

//If our session doesn't exist, redirect & exit script
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    exit;
}
//Get user information from session
$loggedInUser = $_SESSION['loggedInUser'];

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $klant = mysqli_real_escape_string($db, $_POST['klant_id']);
    $datum = mysqli_escape_string($db, $_POST['datum']);
    $decoratie = mysqli_escape_string($db, $_POST['decoratie']);
    $soort_evenement = mysqli_escape_string($db, $_POST['soort_evenement']);
    $locatie_evenement = mysqli_escape_string($db, $_POST['locatie_evenement']);

    //Require the form validation handling
    require_once "includes/form-validation.php";



    if (empty($errors)) {
        //Store image & retrieve name for database saving
        $klantId = $loggedInUser['klant_id'];

        //Save the record to the database
        $query = "INSERT INTO afspraken
                  (datum, klant_id, decoratie, soort_evenement, locatie_evenement)
                  VALUES ('$datum', '$klantId', '$decoratie', '$soort_evenement', '$locatie_evenement')";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query . '<br>' . mysqli_error($db));

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

// Get all artist names for dropdown
require_once 'includes/klanten-data.php';

?>
<!doctype html>
<html lang="en">
<head>
    <title>Afspraak creeeren</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Creeer afspraak voor <?= $loggedInUser['name']; ?></h1>

<?php
if (isset($success)) { ?>
    <p class="success">Je nieuwe afspraak is toegevoegd aan de database</p>
<?php } ?>

<!-- enctype="multipart/form-data" no characters will be converted -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="data-field">
        <label for="datum">Datum</label><p></p>
        <input id="datum" type="text" name="datum" value="<?= (isset($name) ? $datum : ''); ?>"/>
        <span class="errors"><?= isset($errors['datum']) ? $errors['datum'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="decoratie">Decoratie</label><p></p>
        <input id="decoratie" type="text" name="decoratie" value="<?= (isset($genre) ? $decoratie : ''); ?>"/>
        <span class="errors"><?= isset($errors['decoratie']) ? $errors['decoratie'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="soort_evenement">Soort Evenement</label><p></p>
        <input id="soort_evenement" type="text" name="soort_evenement" value="<?= (isset($year) ? $soort_evenement : ''); ?>"/>
        <span class="errors"><?= isset($errors['soort_evenement']) ? $errors['soort_evenement'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="locatie_evenement">Locatie Evenement</label><p></p>
        <input id="locatie_evenement" type="text" name="locatie_evenement" value="<?= (isset($tracks) ? $locatie_evenement : ''); ?>"/>
        <span class="errors"><?= isset($errors['locatie_evenement']) ? $errors['locatie_evenement'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Terug naar de lijst</a>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
