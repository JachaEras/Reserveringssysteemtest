<?php
/** @var mysqli $db */
require_once "includes/database.php";


//Retrieve the GET parameter from the 'Super global'
$afspraakId = $_GET['id'];


//Remove from the database
$query = "DELETE FROM afspraken WHERE id = " . mysqli_escape_string($db, $afspraakId);

mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

//Close connection
mysqli_close($db);

//Redirect to homepage after deletion & exit script
header("Location: index.php");
exit;