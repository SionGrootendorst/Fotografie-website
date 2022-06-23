<?php


$db_hostname = 'localhost';
$db_username = 'db_Foto';
$db_password = '#1Geheim';
$db_database = 'db_Foto';

// Dit is de beheerder van de pagina
$admin = "";

// Maak verbinding met de database
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

//Als de verbinding niet gemaakt kan worden: geef een melding
if (!$mysqli) {
    echo "FOUT: geen connectie naar database. <br>";
    echo "Error: " . mysqli_connect_error() . "<br/>";
    exit;
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);