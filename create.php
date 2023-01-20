<?php
/** @var mysqli $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "database.php";
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $naam = mysqli_real_escape_string($db, $_POST['naam']);
    $telefoonnummer = mysqli_real_escape_string($db, $_POST['telefoonnummer']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $datum_tijd = mysqli_real_escape_string($db, $_POST['datum_tijd']);
    $behandeling = mysqli_real_escape_string($db, $_POST['behandeling']);
    $extra_info = mysqli_real_escape_string($db, $_POST['extra_info']);

    //Require the form validation handling
    require_once "form-validation.php";

    if (empty($errors)) {

        //Save the record to the database
        $query = "INSERT INTO `kappersafspraken` (naam, telefoonnummer, email, datum_tijd, behandeling, extra_info)
              VALUES ('$naam', '$telefoonnummer', '$email', '$datum_tijd', '$behandeling', '$extra_info')";
        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

        //Close connection
        mysqli_close($db);

        // Redirect to bedankt.html
        header('Location: bedankt.html');
        exit;
    }
}
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
    <section class="section is-small">
        <div class="box">
            <form method="post" action="">
                <div class="field">
                    <label class="label">Naam</label>
                    <div class="control">
                        <input class="input" name="naam" type="text" placeholder="Naam" value="<?= $naam ?? '' ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['naam'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label" for="phone">Telefoonnummer</label>
                    <div class="control">
                        <input class="input" name="telefoonnummer" id="phone" type="tel"
                               placeholder="Telefoonnummer" value="<?= $telefoonnummer ?? '' ?>"
                        >
                    </div>
                    <p class="help is-danger">
                        <?= $errors['telefoonnummer'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input name="email" class="input" type="email" placeholder="Email" value="<?= $email ?? '' ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['email'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Datum en tijd</label>
                    <div class="control">
                        <input name="datum_tijd" class="input" type="datetime-local" value="<?= $datum_tijd ?? '' ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['datum_tijd'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Behandeling</label>
                    <div class="control">
                        <input class="input" name="behandeling" type="text" placeholder="Bijvoorbeeld knippen, kleuren, wassen, etc." value="<?= $behandeling ?? '' ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['behandeling'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Extra opmerking</label>
                    <div class="control">
                        <input class="input" name="extra_info" type="text" placeholder="Schrijf hier je extra opmerking" value="<?= $behandeling ?? '' ?>">
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" name="submit" class="button is-success">Bevestigen</button>
                    </div>
                    <div class="control">
                        <a href="index.html" class="button is-light">Annuleren</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

</body>
</html>
