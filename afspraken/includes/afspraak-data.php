
<?php

/** @var mysqli $db */
require_once "database.php";

//Get the result set from the database with a SQL query
$query = "SELECT 
                afspraken.*,
                klanten.voornaam as klant_name 
          FROM afspraken
          INNER JOIN klanten ON afspraken.klant_id = klanten.id";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$afspraken = [];
while ($row = mysqli_fetch_assoc($result)) {
    $afspraken[] = $row;
}

//Close connection
mysqli_close($db);


?>