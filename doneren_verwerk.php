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

session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

include 'config.php';

if (isset($_POST['submit'])) {

    $fouten = [];
    $_SESSION['fouten'] = array();

    $emailStdnt = mysqli_real_escape_string($mysqli, $_POST['emailStdnt']);
    $emailDonateur = mysqli_real_escape_string($mysqli, $_POST['emailDonateur']);

    $naamStdnt = mysqli_real_escape_string($mysqli, $_POST['naamStdnt']);
    $naamDonateur = mysqli_real_escape_string($mysqli, $_POST['naamStdnt']);

    $naamDonateur = mysqli_real_escape_string($mysqli, $_POST['naamDonateur']);
    $telefoon = mysqli_real_escape_string($mysqli, $_POST['telefoonVeld']);

    $tegenprestatie = mysqli_real_escape_string($mysqli, $_POST['tegenprestatie']);
    $bedrag = mysqli_real_escape_string($mysqli, $_POST['bedragVeld']);

    $std = str_replace("@glr.nl", "", $emailStdnt);

    //------------------------------------------------------------------------------------

    //Validatie voor email van donateur
    if (!filter_var($emailDonateur, FILTER_VALIDATE_EMAIL)) {
        array_push($fouten, 'Ongeldige email');
    }

    //Validatie voor Voornaam en achternaam
    if (preg_match("/^([a-zA-Z' ]+)$/", $naamDonateur) != 1) {
        array_push($fouten, 'U kan geen speciale tekens gebruiken voor uw naam');
    }

    //Validatie voor telefoonnummer
    $patroonTelefoonnummer = "/[0][6] [0-9]{8}/";

    if (preg_match($patroonTelefoonnummer, $telefoon) != 1 || strlen($telefoon) != 11) {
        array_push($fouten, 'Uw telefoon nummer moet met "06" beginnen, gevolgd door een spatie en uw nummer');
    }

    //Validatie voor bedrag
    if (!is_numeric($bedrag) || $bedrag < 5) {
        array_push($fouten, 'Het minimale bedrag is 5 euro');
    }

    // Het bedrag van de gekozen tegenprestatie krijgen
    $tp_bedrag = explode(',', $tegenprestatie);
    $tp_bedrag = explode(' ', $tp_bedrag[0]);


    //Validatie voor tegenprestatie

    if ($tegenprestatie !== '') {
        if ($bedrag < $tp_bedrag[1]) {
            array_push($fouten, 'Uw bedrag is niet hoog genoeg voor de gekozen tegenprestatie');
        }
    } else {
        array_push($fouten, 'U moet een tegenprestatie kiezen');
    }

    //------------------------------------------------------------------------------------

    //Als er geen fouten gevonden zijn
    if (count($fouten) === 0) {

        // Tekst dat naar het email gaat
        htmlspecialchars($mailTxt = '
            <link rel="stylesheet" href="css/doneren.css">
        
            <h1 id="mail_header">GLR Crowdfunding Donatie Voor ' . $naamStdnt . '</h1>
            <ul class="mail_ul">
                <li>Naam: ' . $naamDonateur . '</li>  
                <li>Email: ' . $emailDonateur . '</li>
                <li>Telefoonnummer: ' . $telefoon . '</li>
                <li>Tegenprestatie: ' .  $tegenprestatie . '</li>
                <li>Bedrag: <b>' . $bedrag . ' euro</b></li>
            </ul>
            
            <img src="cid:glrLogo">
            
            <style>
                #mail_header {
                    background: #313382;
                    color: #fff;
                    padding: 10px;
                }
                
                img {
                width: 100px;
                float: right;
                }
            </style>
            ');

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'glrcrowdfunding@gmail.com';
            $mail->Password = 'GlrCr0wdFunding003';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('glrcrowdfunding@gmail.com');
            $mail->addAddress($emailStdnt);
            $mail->AddCC('bruining@glr.nl');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'GLR Crowdfunding Donatie';
            $mail->Body = $mailTxt;
            $mail->AltBody = 'Hallo , Uw account gegevens zijn: gebruikersnaam: ' .
                ' Wachtwoord: ';
            $mail->addEmbeddedImage('img/glrLogo.png', 'glrLogo');

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        mysqli_query($mysqli, "INSERT INTO donaties
               (naam_student, email_student, naam_donateur, email_donateur, telefoonnummer, bedrag, tegenprestatie)
               VALUES ('$naamStdnt', '$emailStdnt', '$naamDonateur', '$emailDonateur', '$telefoon', $bedrag, '$tegenprestatie')")
            or die('Je bent net zo dom als Sem');
        echo 'gegevens opgeslagen';

        //Bedrag op student pagina updaten met bedrag van donateur
        $queryStorten = "SELECT gedoneerd FROM profiel WHERE email = '$emailStdnt'";
        $resultStorten = mysqli_query($mysqli, $queryStorten);
        if ($rowSort = mysqli_fetch_array($resultStorten)) {
            $gedoneerdBedrag = $rowSort['gedoneerd'];

            //Het huidige bedrag plus het gedoneerde bedrag doen
            $nieuweBedrag = $gedoneerdBedrag + $bedrag;

            $sql = "UPDATE profiel SET gedoneerd = $nieuweBedrag WHERE email = '$emailStdnt'";

            if (mysqli_query($mysqli, $sql)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($mysqli);
            }
        }

        $_SESSION['gedoneerd'] = 1;
        header('Location: overzicht.php');
    }

    //Als er een fout is gevonden mag niks worden verstuurd en moet die terug naar de doneer pagina
    else {


        $_SESSION['fouten'] = $fouten;

        header("Location: doneren.php?id=" . $std);
    }
}
?>
</body>
</html>


