<?php
//Require DB settings with connection variable
require_once "database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM klanten";
$result = mysqli_query($db, $query)
or die('Error: '.$query);

//Loop through the result to create a custom array
$klanten = [];
while ($row = mysqli_fetch_assoc($result)) {
    $klanten[] = $row;
}