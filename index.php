<?php
/** @var mysqli $db */

//Require DB settings with connection variable
require_once "database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM kappersafspraken";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//Loop through the result to create a custom array
$afspraken = [];
while ($row = mysqli_fetch_assoc($result)) {
    $afspraken[] = $row;
}

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
    <title>Miranda's Knipboetiek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/logoMK.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

</head>
<body>
<main>
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
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <img src="img/user.png">
                </img>
            </div>
        </div>
    </div>
</nav>

<div class="container px-4">
    <h1 class="subtitle mt-4">Afspraken</h1>
    <hr>
    <div class="is-justify-content-space-around	">
    <table class="table is-striped">
        <thead>
        <tr>
            <th>Naam</th>
            <th>Telefoonnummer</th>
            <th>E-mail</th>
            <th>Datum en tijd</th>
            <th>Behandeling</th>
            <th>Extra Opmerking</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        </tfoot>
        <tbody>
        <?php foreach ($afspraken as $index => $afspraakItem) { ?>
            <tr>
                <td><?= $afspraakItem['naam'] ?></td>
                <td>0<?= $afspraakItem['telefoonnummer'] ?></td>
                <td><?= $afspraakItem['email'] ?></td>
                <td><?= $afspraakItem['datum_tijd'] ?></td>
                <td><?= $afspraakItem['behandeling'] ?></td>
                <td><?= $afspraakItem['extra_info'] ?></td>
                <td><a class="button" href="details.php?id=<?= $afspraakItem['id'] ?>">Details</a></td>
                <td><a class="button is-warning is-light" href="update.php?id=<?= $afspraakItem['id'] ?>">Bewerken</a></td>
                <td><a class="button is-danger" href="delete.php?id=<?= $afspraakItem['id'] ?>">Verwijderen</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
</div>
</main>
</body>
</html>



