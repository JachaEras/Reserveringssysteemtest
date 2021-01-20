<?php
//Require DB settings with connection variable
require_once "includes/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM klanten";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//Loop through the result to create a custom array
$klanten = [];
while ($row = mysqli_fetch_assoc($result)) {
    $klanten[] = $row;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Klanten</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Klanten</h1>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Voornaam</th>
        <th>Achternaam</th>
        <th>E-mail</th>
        <th>Telefoonnummer</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="10">&copy; Klanten</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($klanten as $klant) { ?>
        <tr>
            <td><?= $klant['id'] ?></td>
            <td><?= $klant['voornaam'] ?></td>
            <td><?= $klant['achternaam'] ?></td>
            <td><?= $klant['email'] ?></td>
            <td><?= $klant['telefoonnummer'] ?></td>
            <td><a href="details.php?id=<?= $klant['id'] ?>">Details</a></td>
            <td><a href="edit.php?id=<?= $klant['id'] ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $klant['id'] ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>

