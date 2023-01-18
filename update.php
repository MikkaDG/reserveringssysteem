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
$afspraakId = mysqli_escape_string($db, $_GET['id']);

//Get the record from the database result
$query = "SELECT * FROM kappersafspraken WHERE id = '$afspraakId'";
$result = mysqli_query($db, $query)
or die ('Error: ' . $query);

//If the album doesn't exist, redirect back to the homepage
if (mysqli_num_rows($result) != 1) {
    header('Location: index.php');
    exit;
}

//Transform the row in the DB table to a PHP array
$afspraken = mysqli_fetch_assoc($result);

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
//Postback with the data showed to the user, first retrieve data from 'Super global'
    $naam = mysqli_real_escape_string($db, $_POST['naam']);
    $telefoonnummer = mysqli_real_escape_string($db, $_POST['telefoonnummer']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $datum_tijd = mysqli_real_escape_string($db, $_POST['datum_tijd']);
    $behandeling = mysqli_real_escape_string($db, $_POST['behandeling']);
    $extra_info = mysqli_real_escape_string($db, $_POST['extra_info']);

//Require the form validation handling
    require_once "form-validation.php";

    // Als alles ingevuld is dan stuur door naar de database en stuur door naar index pagina.
    if (empty($errors)) {
        $query = "UPDATE `kappersafspraken` SET `naam`='$naam',`telefoonnummer`='$telefoonnummer',`email`='$email',`datum_tijd`='$datum_tijd',`behandeling`='$behandeling',`extra_info`='$extra_info' WHERE id = '$afspraakId'";
        mysqli_query($db, $query);
        header('Location: details.php');
        exit;
    }
}

//Close connection
mysqli_close($db);

?>

<!DOCTYPE html>
<html>
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
                        Medewerker log-in
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<main>
    <section class="section">
        <div class="box">
            <form method="post" action="">
                <div class="field">
                    <label class="label">Naam</label>
                    <div class="control">
                        <input class="input" name="naam" type="text" value="<?= $afspraken['naam'] ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['naam'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label" for="phone">Telefoonnummer</label>
                    <div class="control">
                        <input class="input" name="telefoonnummer" id="phone" type="tel"
                               value="0<?= $afspraken['telefoonnummer'] ?>"
                        >
                    </div>
                    <p class="help is-danger">
                        <?= $errors['telefoonnummer'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input name="email" class="input" type="email" value="<?= $afspraken['email'] ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['email'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Datum en tijd</label>
                    <div class="control">
                        <input name="datum_tijd" class="input" type="datetime-local" value="<?= $afspraken['datum_tijd'] ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['datum_tijd'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Behandeling</label>
                    <div class="control">
                        <input class="input" name="behandeling" type="text" value="<?= $afspraken['behandeling'] ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['behandeling'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Extra opmerking</label>
                    <div class="control">
                        <input class="input" name="extra_info" type="text" value="<?= $afspraken['extra_info'] ?>">
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" name="submit" class="button is-success">Bevestigen</button>
                    </div>
                    <div class="control">
                        <a href="details.php?id=<?= $afspraken['id'] ?>" class="button is-light">Annuleren</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

</body>
</html>
