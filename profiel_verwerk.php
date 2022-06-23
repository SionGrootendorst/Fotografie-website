<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

require 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $fouten = [];

    $naam = mysqli_real_escape_string($mysqli, $_POST['profiel_naam']);
    $email = mysqli_real_escape_string($mysqli, $_POST['profiel_email']);
    $videoURL = mysqli_real_escape_string($mysqli, $_POST['profiel_video']);
    $doelBedrag = mysqli_real_escape_string($mysqli, $_POST['doelbedrag']);
    $omschrijving = mysqli_real_escape_string($mysqli, $_POST['omschrijving']);

    $bedrag = array_filter($_POST['bedrag']);
    $text = array_filter($_POST['tegenprestatie']);

    // Validatie ----------------------------------------------------------- *

    // Naam validatie

    if ($naam === '') {
        array_push($fouten, 'Uw naam moet ingevuld zijn');
    }

    // Email validatie

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    } else {
        array_push($fouten, 'Email is niet geldig');
    }

    //VideoURL validatie

    if ($videoURL !== '') {

        if (strpos($videoURL, 'watch?v=') !== false) {

            $videoURL = explode( '&', $videoURL);

            $videoURL = str_replace('watch?v=', 'embed/', $videoURL[0]);
        } else {
            array_push($fouten, 'Youtube link is niet geldig');
        }
    } else {
        array_push($fouten, 'Video URL moet ingevuld zijn');
    }

    // Doel bedrag validatie

    if ($doelBedrag !== '') {

        if (!is_numeric($doelBedrag)) {
            array_push($fouten, 'Doneer bedrag moet een getal zijn');
        }

    } else {
        array_push($fouten, 'Doneer bedrag moet ingevuld zijn');
    }

    // Omschrijving validatie

    if ($omschrijving === '') {
        array_push($fouten, 'Omschrijving moet ingevuld zijn');
    }

    // Profiel foto validatie

    if (!isset($_POST['profiel_img'])) {
        array_push($fouten, 'Profiel foto moet worden toegevoegd');
    }

    // Tegenprestatie validatie

    if (empty($bedrag) || empty($text)) {
        array_push($fouten, 'U moet minimaal 1 tegenprestatie toevoegen');
    }

    // Eigen werk validatie

    // Aan database en server toevoegen --------------------------------------------- *

    // Als er fouten zijn stuur terug naar profiel.php
    if (count($fouten) > 0) {
        $_SESSION['error'] = $fouten;
        header('Location: profiel.php');
    } else {
        // @glr.nl van de email verwijderen
        $std = str_replace("@glr.nl", "", $email);

        // dataURL veranderen naar een normale url
        $data = str_replace("data:image/png;base64,", "", $_POST['profiel_img']);

        // Foto op de server opslaan
        $imgURL = "profiel_foto/" . $std . ".png";
        file_put_contents("profiel_foto/" . $std . ".png", base64_decode($data));

        mysqli_query($mysqli, "INSERT INTO profiel (naam, email, doelBedrag, gedoneerd, foto, video, omschrijving, goedgekeurd) VALUES ('$naam', '$email', $doelBedrag, 0,  '$imgURL', '$videoURL', '$omschrijving', 'neutraal')");

        // Gemaakt werk uploaden
        $files = array_filter($_FILES['upload']['name']);
        $total_count = count($_FILES['upload']['name']);

        for ($i = 0; $i < $total_count; $i++) {

            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            if ($tmpFilePath != "") {

                $newfilename = $std;
                $newFilePath = "./fotos/";

                $naam = $newfilename . '_' . $i . ".png";

                mysqli_query($mysqli, "INSERT INTO fotos(foto, studentnummer) VALUES('$naam', $std)")
                or die("Could not execute the insert query. ");

                if (move_uploaded_file($tmpFilePath, $newFilePath . $newfilename . '_' . $i . ".png")) {
                }
            }
        }

        for ($i = 0; $i < count($bedrag); $i++) {

            $bedrag[$i] = mysqli_real_escape_string($mysqli, $bedrag[$i]);
            $text[$i] = mysqli_real_escape_string($mysqli, $text[$i]);

            $nummer = $i + 1;
            mysqli_query($mysqli, "INSERT INTO tegenprestatie(studentnummer, tegenprestatie, bedrag, nummer) VALUES({$std}, '{$text[$i]}', {$bedrag[$i]}, {$nummer})");
        }

        ?>

        <script>alert('Bedankt! Uw profiel wordt beoordeeld door uw begeleider')</script>

        <?php
        header('Refresh:1; overzicht.php', true, 303);
    }

} else {
    header('Location: profiel.php');
}
?>

</body>
</html>
