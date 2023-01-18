<?php
/** @var mysqli $db */

// connectie met de database
require_once "database.php";

//id uit de GET halen
$id = $_GET['id'];

$afspraakId = mysqli_escape_string($db, $_GET['id']);

$query = "DELETE FROM `kappersafspraken` WHERE id = $afspraakId";
mysqli_query($db, $query);

//Redirect to homepage after deletion & exit script
header('Location: index.php');

//Close connection
mysqli_close($db);
