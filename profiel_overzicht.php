<?php

session_start();

include './inc/graph.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profiel_overicht.css">
    <script src="https://kit.fontawesome.com/d56e6d1e10.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">
    <title>Profiel</title>
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
        <?php

        if (isset($_SESSION['isIngelogd'])) {
            ?>

            <a href="login.php?action=logout">
                <div class="login_button_1">
                    <button class="login-button"><i class="fas fa-user-circle"></i> Uitloggen</button>
                </div>
            </a>

            <?php
        } else {
            ?>

            <a href="login.php">
                <div class="login_button_1">
                    <button class="login-button"><i class="fas fa-user-circle"></i> Login</button>
                </div>
            </a>
            <?php
        }

        ?>
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

    <!-- Profiel foto tonen -->
    <?php
    $std = $_GET['studentnummer'];

    ?>
    <a class="doneerKnop" href="./doneren.php?id=<?php echo $std?>">
    <button class="button">
        <span class="button__text">
            Doneer
        </span>
        <svg class="button__svg" role="presentational" viewBox="0 0 600 600">
            <defs>
                <clipPath id="myClip">
                    <rect x="0" y="0" width="100%" height="50%" />
                </clipPath>
            </defs>
            <g clip-path="url(#myClip)">
                <g id="money">
                    <path d="M441.9,116.54h-162c-4.66,0-8.49,4.34-8.62,9.83l.85,278.17,178.37,2V126.37C450.38,120.89,446.56,116.52,441.9,116.54Z" fill="#699e64" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                    <path d="M424.73,165.49c-10-2.53-17.38-12-17.68-24H316.44c-.09,11.58-7,21.53-16.62,23.94-3.24.92-5.54,4.29-5.62,8.21V376.54H430.1V173.71C430.15,169.83,427.93,166.43,424.73,165.49Z" fill="#699e64" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                </g>
                <g id="creditcard">
                    <path d="M372.12,181.59H210.9c-4.64,0-8.45,4.34-8.58,9.83l.85,278.17,177.49,2V191.42C380.55,185.94,376.75,181.57,372.12,181.59Z" fill="#a76fe2" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                    <path d="M347.55,261.85H332.22c-3.73,0-6.76-3.58-6.76-8v-35.2c0-4.42,3-8,6.76-8h15.33c3.73,0,6.76,3.58,6.76,8v35.2C354.31,258.27,351.28,261.85,347.55,261.85Z" fill="#ffdc67" />
                    <path d="M249.73,183.76h28.85v274.8H249.73Z" fill="#323c44" />
                </g>
            </g>
            <g id="wallet">
                <path d="M478,288.23h-337A28.93,28.93,0,0,0,112,317.14V546.2a29,29,0,0,0,28.94,28.95H478a29,29,0,0,0,28.95-28.94h0v-229A29,29,0,0,0,478,288.23Z" fill="#a4bdc1" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                <path d="M512.83,382.71H416.71a28.93,28.93,0,0,0-28.95,28.94h0V467.8a29,29,0,0,0,28.95,28.95h96.12a19.31,19.31,0,0,0,19.3-19.3V402a19.3,19.3,0,0,0-19.3-19.3Z" fill="#a4bdc1" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                <path d="M451.46,435.79v7.88a14.48,14.48,0,1,1-29,0v-7.9a14.48,14.48,0,0,1,29,0Z" fill="#a4bdc1" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                <path d="M147.87,541.93V320.84c-.05-13.2,8.25-21.51,21.62-24.27a42.71,42.71,0,0,1,7.14-1.32l-29.36-.63a67.77,67.77,0,0,0-9.13.45c-13.37,2.75-20.32,12.57-20.27,25.77l.38,221.24c-1.57,15.44,8.15,27.08,25.34,26.1l33-.19c-15.9,0-28.78-10.58-28.76-25.93Z" fill="#7b8f91" />
                <path d="M148.16,343.22a6,6,0,0,0-6,6v92a6,6,0,0,0,12,0v-92A6,6,0,0,0,148.16,343.22Z" fill="#323c44" />
            </g>

        </svg>
    </button>
    </a>

    <!-- Naam studenten -->
    <div class="geheelProfiel">
        <?php
        require 'config.php';

        //Laten zien van de naam, video en beschrijving
        $query = "SELECT * FROM profiel WHERE email = '" . $std . "@glr.nl'";
       
        $result = mysqli_query($mysqli, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $naam = $row['naam'];
                $video = $row['video'];
                $omschrijving = $row['omschrijving'];

        ?>

                <strong>
                    <h1><?php echo $naam ?></h1>
                </strong>

                <iframe width="480" height="280" src="<?php echo $video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <div class="beschrijving">
                    <p><?php echo nl2br($omschrijving) ?></p>
                </div>

        <?php
            }
        }

        ?>
        <!-- Div voor tegenprestaties -->
        <div class="tegenprestaties">
            <?php

            //Tegenprestaties laten zien

            $queryPrestatie = "SELECT * FROM tegenprestatie WHERE studentnummer = $std";
            $resultPrestatie = mysqli_query($mysqli, $queryPrestatie);

            if ($resultPrestatie->num_rows > 0) {
                while ($rowPrestatie = $resultPrestatie->fetch_assoc()) {
                    $nummer = $rowPrestatie['nummer'];
                    $prestatie = $rowPrestatie['tegenprestatie'];
                    $bedrag = $rowPrestatie['bedrag'];

                    echo "<p class='prestatieP'><strong>Tegenprestatie " . $nummer . ":</strong> <br> Voor €" . $bedrag . ",- " . $prestatie . "</p><br>";
                }
            }

            ?>

        </div>

        <!-- Div voor de bedragen -->
        <div class="bedragen">

            <?php

            $queryBedragen = "SELECT * FROM profiel WHERE email = '" . $std . ".glr.nl'";
            $resultBedragen = mysqli_query($mysqli, $query);

            if ($resultBedragen->num_rows > 0) {
                while ($rowBedragen = $resultBedragen->fetch_assoc()) {
                    $doelBedrag = $rowBedragen['doelBedrag'];
                    $gedoneerd = $rowBedragen['gedoneerd'];

                    echo "<table>";

                    echo "<tr>";
                    echo "<td>Doel bedrag:</td>";
                    echo "<td class='td'>  €" . $doelBedrag . ",-<td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Gedoneerd bedrag:</td>";
                    echo "<td class='td'>  €" . $gedoneerd . ",-<td>";
                    echo "</tr>";

                    echo "</table>";

            ?>

            <?php
                }
            }

            ?>

        </div>

        <!-- Div voor de foto's -->
        <div class="fotos">

            <?php
            $queryFoto = "SELECT foto FROM fotos WHERE studentnummer = $std";
            $resultFoto = mysqli_query($mysqli, $queryFoto);

            if ($resultFoto->num_rows > 0) {
                $delay = 100;
                while ($rowFoto = $resultFoto->fetch_assoc()) {
                    $foto = $rowFoto['foto'];
            ?>
                    <div class="fotoDiv">
                        <img data-aos="fade-right" data-aos-duration="1000" data-aos-delay="<?php echo $delay ?>" class="werk" src="./fotos/<?php echo $foto ?>" alt="">
                    </div>

            <?php
                    $delay += 100;
                }
            }
            ?>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>