<?php
//Require music data to use variable in this file
/** @var array $afspraken */
require_once "includes/afspraak-data.php";
?>
<!doctype html>
<html lang="en">
<head>
    <title>Afspraken</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Afspraken</h1>
<a href="formulier.php">Creeer nieuwe afspraak</a>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Klant_id</th>
        <th>Klant</th>
        <th>Datum</th>
        <th>Locatie Evenement</th>
        <th>Soort Evenement</th>
        <th>Decoratie</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="10">&copy; Afspraken</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($afspraken as $afspraak) { ?>
        <tr>
            <td><?= $afspraak['id']; ?></td>
            <td><?= $afspraak['klant_id']; ?></td>
            <td><?= $afspraak['klant_name']; ?></td>
            <td><?= $afspraak['datum']; ?></td>
            <td><?= $afspraak['locatie_evenement']; ?></td>
            <td><?= $afspraak['soort_evenement']; ?></td>
            <td><?= $afspraak['decoratie']; ?></td>
            <td><a href="details.php?id=<?= $afspraak['id']; ?>">Details</a></td>
            <td><a href="edit.php?id=<?= $afspraak['id']; ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $afspraak['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
