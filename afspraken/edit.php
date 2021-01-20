<?php

/**
 * @var mysqli $db
 * @var array $klanten
 */
require_once "includes/database.php";



//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $afspraakId = mysqli_escape_string($db, $_POST['id']);
    $klant = mysqli_escape_string($db, $_POST['klant_id']);
    $datum = mysqli_escape_string($db, $_POST['datum']);
    $locatie_evenement = mysqli_escape_string($db, $_POST['locatie_evenement']);
    $soort_evenement = mysqli_escape_string($db, $_POST['soort_evenement']);
    $decoratie = mysqli_escape_string($db, $_POST['decoratie']);


    //Require the form validation handling
    require_once "includes/form-validation.php";

    //Save variables to array so the form won't break
    $afspraak = [
        'klant' => $klant,
        'datum' => $datum,
        'locatie_evenement' => $locatie_evenement,
        'soort_evenement' => $soort_evenement,
        'decoratie' => $decoratie,
    ];

    if (empty($errors)) {


        //Update the record in the database
        $query = "UPDATE afspraken
                  SET datum = '$datum', klant_id = '$klant', locatie_evenement = '$locatie_evenement', soort_evenement = '$soort_evenement', decoratie = '$decoratie'
                  WHERE id = '$afspraakId'";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
    }
} else {
    //Retrieve the GET parameter from the 'Super global'
    $afspraakId = $_GET['id'];

    //Get the record from the database result
    $query = "
            SELECT afspraken.*, klanten.voornaam as klant_name 
            FROM afspraken 
            INNER JOIN klanten ON afspraken.klant_id = klanten.id 
            WHERE afspraken.id = " . mysqli_escape_string($db, $afspraakId);
    $result = mysqli_query($db, $query);
    $afspraak = mysqli_fetch_assoc($result);
}

// Get all artist names for dropdown
require_once 'includes/klanten-data.php';

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Afspraak Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Edit "<?= $afspraak['klant_name'] . ' - ' . $afspraak['datum']; ?>"</h1>
<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="data-field">
        <label for="datum">Datum</label><p></p>
        <input id="datum" type="text" name="datum" value="<?= $afspraak['datum']; ?>"/>
    </div>
    <div class="data-field">
        <label for="decoratie">Decoratie</label><p></p>
        <input id="decoratie" type="text" name="decoratie" value="<?= $afspraak['decoratie']; ?>"/>
    </div>
    <div class="data-field">
        <label for="soort_evenement">Soort_evenement</label><p></p>
        <input id="soort_evenement" type="text" name="soort_evenement" value="<?= $afspraak['soort_evenement']; ?>"/>
    </div>
    <div class="data-field">
        <label for="locatie_evenement">Locatie_evenement</label><p></p>
        <input id="locatie_evenement" type="text" name="locatie_evenement" value="<?= $afspraak['locatie_evenement']; ?>"/>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $afspraakId; ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Terug naar de lijst</a>
</div>
</body>
</html>