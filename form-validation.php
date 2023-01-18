<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($naam == "") {
    $errors['naam'] = 'Vul je naam in';
}
if ($telefoonnummer == "") {
    $errors['telefoonnummer'] = 'Vul je telefoonnummer in';
}
if ($email == "") {
    $errors['email'] = 'Vul je e-mailadres in';
}

if ($datum_tijd == "") {
    $errors['datum_tijd'] = 'Kies een datum en een tijdstip';
}

if ($behandeling == "") {
    $errors['behandeling'] = 'Kies een behandeling';
}