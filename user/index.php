<?php
//Require DB settings with connection variable
require_once "includes/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM gebruikers";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//Loop through the result to create a custom array
$gebruikers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $gebruikers[] = $row;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Gebruikers</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Gebruikers</h1>
<a href="formulier.php">Creeer nieuwe gebruiker</a>
<table>
    <thead>
    <tr>
        <th></th>
        <th>Gebruikersnaam</th>
        <th>Wachtwoord</th>
        <th>Admin ja/nee</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="10">&copy; Gebruikers</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($gebruikers as $gebruiker) { ?>
        <tr>
            <td><?= $gebruiker['id'] ?></td>
            <td><?= $gebruiker['gebruikersnaam'] ?></td>
            <td><?= $gebruiker['wachtwoord'] ?></td>
            <td><?= $gebruiker['is_admin'] ?></td>
            <td><a href="details.php?id=<?= $gebruiker['id'] ?>">Details</a></td>
            <td><a href="edit.php?id=<?= $gebruiker['id'] ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $gebruiker['id'] ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>

