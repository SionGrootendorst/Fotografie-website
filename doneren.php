<?php
session_start()
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doneren</title>
    <link rel="stylesheet" href="css/doneren.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">
</head>

<body>

    <nav>
        <div class="logo">
            <img src=img/glr-logo.webp alt="Logo Image">
        </div>
        <div class="hamburger">
            <div class="bars1"></div>
            <div class="bars2"></div>
            <div class="bars3"></div>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Welkom</a></li>
            <li><a href="./overzicht.php">Deelnemers</a></li>
            <li><a href="./crowdfunding.php">Waarom crowdfunding</a></li>
            <li><a href="./contact.php">Contact</a></li>
        </ul>

    </nav>
    <script>
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");
        const links = document.querySelectorAll(".nav-links li");

        hamburger.addEventListener('click', () => {
            //Links
            navLinks.classList.toggle("open");
            links.forEach(link => {
                link.classList.toggle("fade");
            });

            //Animation
            hamburger.classList.toggle("toggle");
        });
    </script>


    <div class="container-Doneren">
        <div class="info-Doneren">
            <h1>Doneren</h1>
            <p>
                Dank voor uw interesse om aan een of meerdere van de projecten te doneren.​ Hiernaast ziet u een donatie
                formulier waarmee u kan aangeven aan welke student u wil doneren.
            </p>
            <p>
                Als u dit formulier heeft ingevuld wordt u doorgestuurd naar de pagina van de betaalinstructie. U kan hier
                via email direct contact opnemen met de student aan wie u wil doneren. De student neemt dan contact op met
                een betaalverzoek voor de betaling. Hierna komt het bedrag ook direct op de rekening van de student zelf
                terecht en kan u afspraken maken over de gewenste tegenprestatie.
            </p>
            <p>
                Wilt u meerdere donaties doen dan dient u voor elke donatie een formulier in te vullen. De gegevens van het
                donatieformulier worden gebruikt om bij te houden hoeveel de student gedoneerd heeft gekregen.
            </p>
            <p>
                Wij willen iedereen die gedoneerd heeft voor het project heel hartelijk danken.
            </p>
            <p class="schuin">
                De studenten zijn zelf verantwoordelijk voor het verzorgen van de tegenprestaties. Zij zullen na afloop van
                de campagne contact met u opnemen.
            </p>
        </div>
        <div class="doneren-form">
            <?php

            include 'config.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                header('Location: overzicht.php');
            }

            $stdntEmail = $id . '@glr.nl';

            $result = mysqli_query($mysqli, "SELECT naam FROM profiel WHERE email = '$stdntEmail'") or die('Fout bij het ophalen van data');
            if ($row = $result->fetch_assoc()) {
                $naam = $row['naam'];
            }

            $token = uniqid();
            $_SESSION['token'] = $token;
            ?>
            <h2>Donatie Formulier | <?= $naam ?></h2>
            <form class="form" action="doneren_verwerk.php" method="post">

                <input type="hidden" name="emailStdnt" value="<?= $stdntEmail ?>">
                <input type="hidden" name="naamStdnt" value="<?= $naam ?>">
                <input type="hidden" value="<?php echo $token ?>" name="token">

                <label for="naam">Voornaam & achternaam:</label><br>
                <input type="text" name="naamDonateur" required><br>

                <div class="inputs1">

                    <div class="deel1">
                        <label for="email">Email:</label><br>
                        <input id="email" placeholder="voorbeeldemail@gmail.com" type="email" name="emailDonateur" required>
                    </div>

                    <div class="deel2">
                        <label for="telefoonnummer">Telefoonnummer:</label><br>
                        <input type="text" placeholder="Bijv: 06 12345678" name="telefoonVeld" required>
                    </div>
                </div>

                <div class="inputs2">
                    <div class="deel3">
                        <label for="bedrag">Bedrag (Minimale donatie €5,- ):</label><br>
                        <input type="number" name="bedragVeld" required>

                    </div>

                    <div class="deel4">
                        <label for="bedrag">Kies een tegenprestatie</label><br>
                        <select name="tegenprestatie" required>
                            <option value=""></option>
                            <?php

                            $result = mysqli_query($mysqli, "SELECT * FROM tegenprestatie WHERE studentnummer = $id") or die('Fout bij het ophalen van de tegenprestaties');
                            while ($row = $result->fetch_assoc()) {
                                $tegenprestatie = $row['tegenprestatie'];
                                $bedrag = $row['bedrag'];
                                echo '<option>€ ' . $bedrag . ',- ' . $tegenprestatie . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <button class="learn-more" type="submit" name="submit">
                    <span class="circle" aria-hidden="true">
                        <span class="icon arrow"></span>
                    </span>
                    <span class="button-text">Verstuur</span></button>

            </form>
            <img class="img-Doneren" src="img/glrLogo.png" width="100px">
        </div>
    </div>

    <div id="snackbar">Some text some message..</div>

    <?php

    if (isset($_SESSION['fouten'])) {
    ?>
        <script>
            let x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 15000);

            x.innerHTML = '<?php foreach ($_SESSION['fouten'] as $fout) {
                                echo "<br> • $fout";
                            }

                            unset($_SESSION['fouten']);
                            ?>';
        </script>
    <?php
    }

    ?>


</body>



</html>