<?php
//Require music data & image helpers to use variable in this file
require_once "includes/database.php";

if (isset($_POST['submit'])) {
    // DELETE IMAGE
    // To remove the image we need to query the file name from the db.
    // Get the record from the database result
    $query = "SELECT * FROM gebruikers WHERE id = " . mysqli_escape_string($db, $_POST['id']);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    $gebruiker = mysqli_fetch_assoc($result);


    // DELETE DATA
    // Remove the album data from the database
    $query = "DELETE FROM gebruikers WHERE id = " . mysqli_escape_string($db, $_POST['id']);

    mysqli_query($db, $query) or die ('Error: '.mysqli_error($db));

    //Close connection
    mysqli_close($db);

    //Redirect to homepage after deletion & exit script
    header("Location: index.php");
    exit;

} else if(isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $gebruikerId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM gebruikers WHERE id = " . mysqli_escape_string($db, $gebruikerId);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    if(mysqli_num_rows($result) == 1)
    {
        $gebruiker = mysqli_fetch_assoc($result);
    }
    else {
        // redirect when db returns no result
        header('Location: index.php');
        exit;
    }
} else {
    // Id was not present in the url OR the form was not submitted

    // redirect to index.php
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete - <?= $gebruiker['gebruikersnaam'] ?></title>
</head>
<body>
<h2>Delete - <?= $gebruiker['gebruikersnaam'] ?></h2>
<form action="" method="post">
    <p>
        Weet u zeker dat u deze gebruiker "<?= $gebruiker['gebruikersnaam']?>" wilt verwijderen?
    </p>
    <input type="hidden" name="id" value="<?= $gebruiker['id'] ?>"/>
    <input type="submit" name="submit" value="Verwijderen"/>
</form>
<div>
    <a href="index.php">Ga terug naar de lijst</a>
</div>
</body>
</html>
