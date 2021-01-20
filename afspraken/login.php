<?php
session_start();
//Require database in this file
/** @var mysqli $db */
require_once "includes/database.php";

//Check if user is logged in, else move to secure page
if (isset($_SESSION['loggedInUser'])) {
    header("Location: formulier.php");
    exit;
}

//If form is posted, lets validate!
if (isset($_POST['submit'])) {
    //Retrieve values (email safe for query)
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    //Get password & name from DB
    $query = "SELECT *
              FROM klanten
              WHERE email = '$email'";
    $result = mysqli_query($db, $query) or die('Error: '.$query);
    $klanten = mysqli_fetch_assoc($result);

    //Check if email exists in database
    $errors = [];
    if ($klanten) {
        //Validate password
        if (password_verify($password, $klanten['password'])) {
            //Set email for later use in Session
            $_SESSION['loggedInUser'] = [
                'name' => $klanten['voornaam'],
                'id' => $klanten['klant_id']
            ];

            //Redirect to secure.php & exit script
            header("Location: formulier.php");
            exit;
        } else {
            $errors[] = 'Uw logingegevens zijn onjuist';
        }
    } else {
        $errors[] = 'Uw logingegevens zijn onjuist';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Klant Login</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Login</h1>
<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form id="login" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
    <div>
        <label for="email">E-mail</label><p></p>
        <input type="email" name="email" id="email" value="<?= (isset($email) ? $email : ''); ?>"/>
    </div>
    <div>
        <label for="password">Wachtwoord</label><p></p>
        <input type="password" name="password" id="password"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Login"/>
    </div>
</form>
<a href="register.php">Register</a>
<div>
    <a href="index.php">Terug naar de lijst</a>
</div>
</body>
</html>
