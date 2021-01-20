<?php
//Require DB settings with connection variable
/** @var $db */
require_once "database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM gebruikers";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$gebruikers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $gebruikers[] = $row;
}

//Close connection
mysqli_close($db);

