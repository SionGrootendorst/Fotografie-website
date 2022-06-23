<?php
include './inc/auth.php';
$Auth = new modAuth();
include './inc/graph.php';
include "config.php";


if ($_SESSION["gebruiker"] !== $Auth->userName) {
    header('Location: overzicht.php');
}


$std = str_replace("@glr.nl", "", $Auth->userName);
$query = "SELECT DISTINCT * FROM profiel WHERE goedgekeurd = 'neutraal'";

$result = mysqli_query($mysqli, $query);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beheer Pagina</title>
    <script src="https://kit.fontawesome.com/d56e6d1e10.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/beheerPagina.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
            integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="js/beheer.js" defer></script>
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

<div class="container-Beheer">

    <!-- Side nav -->
    <div id="sidenav_container">

        <div id="sidenav_links">
            <div id="sidenav_goedkeuring" class="sidenav_links_item btn-primary"><i class="fas fa-thumbs-up"></i></div>
            <div id="sidenav_donatie" class="sidenav_links_item btn-primary"><i class="fas fa-hand-holding-usd"></i>
            </div>
            <div id="sidenav_accounts" class="sidenav_links_item btn-primary"><i class="fas fa-user-circle"></i></div>
            <button id="sidenav_beheer" class="sidenav_links_item" data-toggle="modal" data-backdrop="static"
                    data-target="#profiel_foto_modal"><i class="fas fa-users-cog"></i></button>
            <div id="beheerToevoegen"></div>
        </div>

        <div id="sidenav_rechts">
            <div id="goedkeuring">
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM profiel WHERE goedgekeurd = 'neutraal' ");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $naam = $row['naam'];
                        $id = $row['id'];
                        echo '<div class="sidenav_item btn btn-primary" id="(' . $id . ')">' . $naam . '</div>';

                    }
                }

                ?>
            </div>
            <div id="donaties">
                <div id="alle_donaties" class="sidenav_item1 btn btn-success">Alle Donaties</div>
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM profiel");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $naam = $row['naam'];
                        $email = $row['email'];
                        echo '<div class="sidenav_item1 btn btn-primary" id="(' . $email . ')">' . $naam . '</div>';

                    }
                }

                ?>
            </div>
            <div id="accounts">
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM profiel");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $naam = $row['naam'];
                        $id = $row['id'];
                        echo '<div class="sidenav_item2 btn btn-primary" id="(' . $id . ')">' . $naam . '</div>';

                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div id="profiel_container">

        <div class="naam_container">
            <strong>
                <h1 id="naam"></h1>
            </strong>
        </div>

        <!-- Goedkeuring -->
        <div id="button_container">
        </div>


        <div class="video_container">
            <iframe id="video" width="480" height="280" src="" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>

        <div class="omschrijving_container">
            <p id="omschrijving"></p>
        </div>

        <!-- Div voor de bedragen -->
        <div class="bedragen">

            <p id="doel_bedrag"></p>
            <p id="gedoneerd"></p>

        </div>

        <!-- Div voor tegenprestaties -->
        <div id="tegenprestaties">

        </div>


        <!-- Div voor de foto's -->
        <div id="fotos">

        </div>
    </div>

    <div id="donatie_container">
        <div class="table-wrapper">
            <table class="fl-table" id="donatie_table">
                <tr>
                    <th>Ontvanger</th>
                    <th>Donateur</th>
                    <th>Email Donateur</th>
                    <th>Bedrag</th>
                    <th>Tegenprestatie</th>
                    <th></th>
                </tr>
            </table>
        </div>
    </div>

    <div id="accounts_container">
        <div class="naam_container1">
            <strong>
                <h1 id="naam1"></h1>
            </strong>
        </div>

        <!-- Goedkeuring -->
        <div id="button_container1">
        </div>


        <div class="video_container1">
            <iframe id="video1" width="480" height="280" src="" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>

        <div class="omschrijving_container1">
            <p id="omschrijving1"></p>
        </div>

        <!-- Div voor de bedragen -->
        <div class="bedragen1">

            <p id="doel_bedrag1"></p>
            <p id="gedoneerd1"></p>

        </div>

        <!-- Div voor tegenprestaties -->
        <div id="tegenprestaties1">

        </div>


        <!-- Div voor de foto's -->
        <div id="fotos1">

        </div>
    </div>


    <!-- Profiel foto aanpassen modal -->
    <div class="modal fade" id="profiel_foto_modal" tabindex="-1" role="dialog"
         aria-labelledby="Profiel Foto Toevoegen" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Beheerder aanmaken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="page">
                        <div id="b_container">
                            <p>
                                <label class="b_label">Naam</label>
                                <input type="text" id="b_naam">
                            </p>

                            <p>
                                <label class="b_label">Email</label>
                                <input type="text" id="b_email" placeholder="naam@glr.nl">
                            </p>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                    <button type="button" class="btn btn-success btn save modal_btn" id="save_btn"
                            data-dismiss="modal">Beheerder opslaan
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>