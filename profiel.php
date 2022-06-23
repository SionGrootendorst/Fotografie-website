<?php
session_start();

include './inc/auth.php';
$Auth = new modAuth();

include './inc/graph.php';

$Graph = new modGraph();
$profiel = $Graph->getProfile();
$photo = $Graph->getPhoto();

include "config.php";

$_SESSION['isIngelogd'] = 1;


if (isset($_SESSION['gebruiker']) && $Auth->userName === $_SESSION['gebruiker']) {
    header('Location: beheerPagina.php');
}

$result = mysqli_query($mysqli, "SELECT * FROM profiel WHERE email = '" . $Auth->userName . "'");

// redirect als de bezoeker al een profiel heeft
if ($result->num_rows > 0) {
    header('Location: overzicht.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name=d"viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profiel</title>

    <script src="https://kit.fontawesome.com/d56e6d1e10.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
            integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module" src="node_modules/cropper/dist/cropper.js" defer></script>
    <script type="module" src="node_modules/cropperjs/dist/cropper.js" defer></script>
    <link rel="stylesheet" href="node_modules/cropper/dist/cropper.css" defer>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="js/cropperScript.js" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
          crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all"
          rel="stylesheet" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">

    <link rel="stylesheet" href="css/profiel.css">
    <script src="js/profiel.js" defer></script>
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

<?php


?>

<form method="POST" action="profiel_verwerk.php" id="profiel_form" enctype="multipart/form-data">

    <div id="cssmenu">
        <ul>
            <li id="bc_6"><a><span>Portfolio foto's</span></a></li>
            <li id="bc_5"><a><span>Omschrijving</span></a></li>
            <li id="bc_4"><a><span>Tegenprestaties</span></a></li>
            <li id="bc_3"><a><span>Doneer doel</span></a></li>
            <li id="bc_2"><a><span>Profiel Foto</span></a></li>
            <li id="bc_1"><a><span>Video</span></a></li>
            <li id="bc_0" class="active"><a href="#"><span>Naam</span></a></li>
        </ul>
    </div>

    <div id="form_container">

        <!-- Naam en email toevoegen -->
        <div id="naam_container" class="item_container">
            <div class="item_main">

                <h3>Controleer uw naam</h3>
                <div class="student_info"><label>Naam: <?= $profiel->displayName ?> </label></div>
                <div class="student_info"><label>Email: <?= $Auth->userName ?> </label></div>

                <div><img class="d-block mx-auto mb-4 profiel_img" src="<?= $photo ?>" alt="Profielfoto" width="100"
                          height="100"></div>

                <input type="hidden" name="profiel_naam" value="<?= $profiel->displayName ?>">
                <input type="hidden" name="profiel_email" value="<?= $Auth->userName ?>">

            </div>
            <div class="item_buttons">
                <a href="login.php?action=logout" type="button" class="btn btn-secondary">Ander profiel</a>
                <button type="button" class="btn next_item naam_gegevens_kloppen" id="naam_btn">Gegevens kloppen
                </button>
            </div>

        </div>

        <!-- Video toevoegen -->
        <div id="videoURL_container" class="item_container">
            <div class="item_main">
                <h3>Video Toevoegen</h3>
                <hr>
                <p class="item_desc">
                    Voeg jouw video linkje toe die jij op jouw profiel pagina wil laten zien.<br>
                    Zorg dat het linkje <span>"watch?v="</span> bevat.
                </p>
                <hr>
                <div class="student_info video_container">
                    <label>Video URL: </label> <input type="text" id="profiel_video" class="student_info_input"
                                                      placeholder="https://www.youtube.com/watch?v="
                                                      name="profiel_video">
                </div>
            </div>

            <div class="item_buttons">
                <button type="button" class="prev_item btn btn-secondary">Terug</button>
                <button type="button" class="btn next_item naam_gegevens_kloppen">Volgende</button>
            </div>
        </div>
        <!-- Profiel foto toevoegen -->
        <div id="profielFoto_container" class="item_container">
            <!-- Profiel foto aanpassen button -->
            <div class="item_main">

                <h3>Profiel Foto Toevoegen</h3>
                <hr>
                <p>
                    Voeg hier jouw profiel foto toe. Deze foto komt op de overzicht pagina. <br>
                    Dit is het eerste dat de bezoekers zullen zien.
                </p>
                <p>
                    Zorg dat de gekozen foto minimaal 450x450 is. <br>
                    Klik op "Crop" om de foto op te slaan.
                </p>
                <hr>

                <button type="button" id="crop_btn" class="btn btn-primary" data-toggle="modal" data-backdrop="static"
                        data-target="#profiel_foto_modal">Profiel foto toevoegen
                </button>

                <!-- Profiel foto aanpassen modal -->
                <div class="modal fade" id="profiel_foto_modal" tabindex="-1" role="dialog"
                     aria-labelledby="Profiel Foto Toevoegen" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Profiel foto aanpassen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="page">

                                    <div class="box">
                                        <input type="file" class="btn btn-primary file_btn" name="file-input"
                                               id="file-input">
                                    </div>

                                    <div class="box-2 img-result">
                                        <div class="result"></div>
                                    </div>

                                    <div class="box-2 hide cropped_img">

                                        <img class="cropped" src="" alt="">

                                    </div>
                                    <div class="box-2">
                                        <button class="btn btn-primary save hide crop_btn">Crop</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                                <button type="button" class="btn btn-primary btn save modal_btn" id="save_btn" disabled
                                        data-dismiss="modal">Foto opslaan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item_buttons">
                <button type="button" class="prev_item btn btn-secondary prev_item">Terug</button>
                <button type="button" class="btn next_item naam_gegevens_kloppen">Volgende</button>
            </div>
        </div

                <!-- Doneer bedrag toevoegen -->
        <div id="doneerDoel_container" class="item_container">
            <div class="item_main">
                <h3>Doneer Doel</h3>
                <hr>
                <p>
                    Voer hier jouw doneer doel in. Dit is het bedrag dat jij hoop te behalen met deze crowdfunding.
                </p>
                <hr>
                <div class="student_info" id="bedrag_inputs"><label id="bedrag_label">Doel bedrag: </label> <input
                            type="number" id="doel_bedrag" id="bedrag_input" name="doelbedrag">
                </div>
            </div>

            <div class="item_buttons">
                <button type="button" class="prev_item btn btn-secondary">Terug</button>
                <button type="button" class="btn next_item naam_gegevens_kloppen">Volgende</button>
            </div>
        </div>

        <!-- tegenprestatie toevoegen -->
        <div id="tegenprestatie_container" class="item_container">
            <div class="item_main">
                <h3>Tegenprestatie</h3>
                <hr>
                <p>
                    Voeg hier jouw tegenprestatie toe. Van goedkoop naar duur. <br>
                    De eerste is minimaal 5 euro.
                </p>
                <p>
                    Klik op "+" om de tegenprestatie toe te voegen.
                </p>
                <hr>

                <!-- Tegenprestatie toevoegen button -->
                <button type="button" id="crop_btn" class="btn btn-primary" data-toggle="modal" data-backdrop="static"
                        data-target="#tegenprestatie_modal">Tegenprestatie toevoegen
                </button>

                <!-- Tegenprestatie modal -->
                <div class="modal fade" id="tegenprestatie_modal" tabindex="-1" role="dialog"
                     aria-labelledby="Tegenprestatie toevoegen" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Tegenprestatie toevoegen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="page">

                                    <div class="box d-flex justify-content-center">

                                        <div id="tp_container">
                                            <p class="tp" id="tp_0">
                                                <?php

                                                for ($i = 0;
                                                $i < 8;
                                                $i++) {
                                                ?>

                                            <div id="<?= $i ?>">

                                                Voor: <input type="number" id="tp_bedrag_<?= $i ?>"
                                                             class="tp_input tp_bedrag"
                                                             data-id="0"
                                                             name="bedrag[]"> euro, Krijgt u
                                                <input type="text" id="tp_text_<?= $i ?>" class="tp_input tp_text"
                                                       data-id="0"
                                                       name="tegenprestatie[]"
                                                       placeholder="tegenprestatie...">

                                                <button type="button" id="tp_btn_<?= $i ?>" class="btn-primary tp_btn">+
                                                </button>

                                            </div>

                                            <?php
                                            }
                                            ?>

                                            </p>
                                        </div>

                                    </div>
                                    <p id="tp_error"></p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren
                                    </button>
                                    <button type="button" class="btn btn-primary btn save modal_btn" id="save_btn"
                                            data-dismiss="modal">Tegenprestatie's opslaan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item_buttons">
                <button type="button" class="prev_item btn btn-secondary">Terug</button>
                <button type="button" class="btn next_item naam_gegevens_kloppen">Volgende</button>
            </div>
        </div>

        <!-- Profiel Foto-->
        <div class="imgURL"></div>

        <div id="omschrijving_container" class="item_container">
            <div class="item_main">
                <h3>Omschrijving</h3>
                <hr>
                <p>Schrijf hier iets over jezelf en het werk dat je hebt gemaakt</p>
                <hr>
                <div class="student_info"><textarea id="omschrijving" name="omschrijving"
                                                    placeholder="Hallo ik ben..."></textarea></div>
            </div>

            <div class="item_buttons">
                <button type="button" class="prev_item btn btn-secondary">Terug</button>
                <button type="button" class="btn next_item naam_gegevens_kloppen">Volgende</button>
            </div>
        </div>

        <!-- fotos toevoegen -->
        <div id="fotos_container" class="item_container">
            <div class="item_main">
                <h3>Eigen werk</h3>
                <hr>
                <p>
                    Voeg hier 3 foto's toe die je zelf hebt gemaakt.<br>
                    Dit komt op jouw profiel pagina.<br><br>
                    Om meerdere foto's te selecteren, houd CTRL (command op Mac) en klik op de foto's

                </p>
                <hr>

                <div class="form-group">
                    <div class="col-sm-9">
            <span class="btn btn-default btn-file">
                <input id="input-2" name="upload[]" type="file" class="file" multiple data-show-upload="true"
                       data-show-caption="true">
            </span>
                    </div>
                </div>
            </div>
            <div class="item_buttons">
                <button type="button" class="prev_item btn btn-secondary">Terug</button>
                <div class="student_info_submit btn btn-success"><input type="submit" id="profiel_submit" name="submit"
                                                                        value="Profiel opslaan"></div>
            </div>
        </div>
    </div>

    <input type="hidden" name="gedoneerdbedrag" value="0">

</form>

<div id="error_container">
    <?php

    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $fout) {
            echo '<p class="error">• ' . $fout . '</p>';
        }
        unset($_SESSION['error']);
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

<script>
    $(document).ready(() => {
        $('.fileinput-upload-button').attr('name', 'upload_foto')
    })
</script>
</body>
</html>
