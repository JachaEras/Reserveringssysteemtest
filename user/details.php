<?php
// redirect when uri does not contain a id
if(!isset($_GET['id'])) {
    // redirect to index.php
    header('Location: index.php');
    exit;
}

//Require database in this file
require_once "includes/database.php";

//Retrieve the GET parameter from the 'Super global'
$gebruikerId = $_GET['id'];

//Get the record from the database result
$query = "SELECT * FROM gebruikers WHERE id = " . mysqli_escape_string($db, $gebruikerId);
$result = mysqli_query($db, $query)
or die ('Error: ' . $query );

if(mysqli_num_rows($result) == 1)
{
    $gebruiker = mysqli_fetch_assoc($result);
}
else {
    // redirect when db returns no result
    header('Location: index.php');
    exit;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>User Details</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1><?= $gebruiker['gebruikersnaam']?> <?=$gebruiker['wachtwoord'] ?></h1>


<ul>
    <li>Admin ja/nee:  <?= $gebruiker['is_admin'] ?></li>
</ul>
<div>
    <a href="index.php">Ga terug naar de lijst</a>
</div>
</body>
</html>

