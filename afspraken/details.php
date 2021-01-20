<?php
/** @var mysqli $db */
require_once "includes/database.php";

//Retrieve the GET parameter from the 'Super global'
$afspraakId = $_GET['id'];

//Get the record from the database result
$query = "SELECT afspraken.*, klanten.voornaam as klant_name 
            FROM afspraken 
            INNER JOIN klanten
            WHERE afspraken.id = " . mysqli_escape_string($db, $afspraakId);
$result = mysqli_query($db, $query);
$afspraak = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Afspraak Details</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1><?= $afspraak['klant_name'] . ' - ' . $afspraak['datum']; ?></h1>


<ul>
    <li>Genre: <?= $afspraak['locatie_evenement']; ?></li>
    <li>Year: <?= $afspraak['soort_evenement']; ?></li>
    <li>Tracks: <?= $afspraak['decoratie']; ?></li>
</ul>
<div>
    <a href="index.php">Terug naar de lijst</a>
</div>
</body>
</html>
