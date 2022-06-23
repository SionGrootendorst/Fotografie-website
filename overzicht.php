<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/overzicht.css">
    <title>Overzicht</title>
    <script src="https://kit.fontawesome.com/d56e6d1e10.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">
</head>

<body>

<?php
session_start();
include './inc/config.php';
include 'config.php';

if (isset($_SESSION['gedoneerd'])) {
    ?>
    <script>alert('Bedankt voor uw dontatie!')</script>

    <?php
    unset($_SESSION['gedoneerd']);
}

?>
<header>
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
            <li id="waarom"><a href="./crowdfunding.php" >Waarom crowdfunding</a></li>
            <li><a href="./contact.php">Contact</a></li>
            <li><a href="profiel.php">Profiel</a></li>

            <?php

            if (isset($_SESSION['isIngelogd'])) {
                ?>
                <li>
                    <a class="login_btn" href="login.php?action=logout">

                            <i class="fas fa-user-circle"></i> Uitloggen

                    </a>
                </li>


                <?php
            } else {
            ?>
                <li>
                    <a class="login_btn" href="login.php"><i class="fas fa-user-cog"></i>Login</a>
                </li>
                <?php
            }
            if (isset($_SESSION['gebruiker'])) {
                ?>

                <li>
                    <a class="login_btn" href="beheerPagina.php">

                           <i class="fas fa-user-cog"></i>Beheer

                    </a>
                </li>


                <?php
            }
            ?>

        </ul>


    </nav>
</header>
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

<div class="motto">
    <h1>GLR <br> FOTOGRAFIE <br> CROWDFUNDING</h1>
</div>

<div class="zetMidden">
    <div class="geheel">

        <?php
        $query = "SELECT * FROM profiel WHERE goedgekeurd = 'ja' ORDER BY RAND()";
        $result = mysqli_query($mysqli, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $naam = $row['naam'];
                $email = $row['email'];
                // @glr.nl van de email verwijderen
                $studentnummer = str_replace("@glr.nl", "", $email);

                ?>
                <div class="divje" data-aos="fade" data-aos-duration="2000" data-aos-delay="180">
                    <a href="./profiel_overzicht.php?studentnummer=<?php echo $studentnummer ?>">
                        <div class="divie">

                            <div id="content" class="imgDiv">
                                <img class="studentFoto" src="profiel_foto/<?php echo $studentnummer ?>.png" alt="">

                            </div>

                            <div id="b" class="naamDiv">
                                <p class="naam"><?php echo $naam ?></p>
                            </div>

                        </div>
                    </a>
                </div>

                <?php
            }
        } else {
            echo "Er is nog geen profiel";
        }
        ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        offset: 10,
    });
</script>
</body>

</html>