<?php
//Require database in this file
/** @var $db */
require_once "database.php";

//If the ID isn't given, redirect to the homepage
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: index.php');
    exit;
}

//Retrieve the GET parameter from the 'Super global'
$afspraakId = $_GET['id'];

//Get the record from the database result
$query = "SELECT * FROM kappersafspraken WHERE id = " . $afspraakId;
$result = mysqli_query($db, $query);

//If the album doesn't exist, redirect back to the homepage
if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit;
}

//Transform the row in the DB table to a PHP array
$afspraken = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/logoMK.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <title>Miranda's Knipboetiek</title>
</head>
<body>

<section class="hero is-small has-background-black">
    <div class="hero-body">
        <p class="title">
            Miranda's Knipboetiek
        </p>
    </div>
</section>

<nav class="navbar has-background-black" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.html">
            <img src="img/logoMK.jpg">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item has-text-white">
                Prijzen
            </a>

            <a class="navbar-item has-text-white">
                Contact
            </a>

        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-light" href="index.php">
                        Profielfoto
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
<main>
<div class="container px-4 mt-5">
    <div class="box">
        <section class="content">
            <ul>
                <h1 class="subtitle">Reservering van <?= $afspraken['naam'] ?></h1>
                <li>Telefoonnummer: 0<?= $afspraken['telefoonnummer'] ?></li>
                <li>E-mailadres: <?= $afspraken['email'] ?></li>
                <li>Datum en tijd: <?= $afspraken['datum_tijd'] ?></li>
                <li>Behandeling: <?= $afspraken['behandeling'] ?></li>
                <li>Extra info: <?= $afspraken['extra_info'] ?></li>
            </ul>
        </section>
        <div class="is-flex-direction-row">
            <a class="button is-light" href="index.php">Ga terug naar afspraken</a>
            <a class="button is-warning is-light" href="update.php?id=<?= $afspraken['id'] ?>">Bewerken</a>
            <a class="button is-danger" href="delete.php?id=<?= $afspraken['id'] ?>">Verwijderen</a>

        </div>
    </div>
</div>
</main>
</body>
</html>