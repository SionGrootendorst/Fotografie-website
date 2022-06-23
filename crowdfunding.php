<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Waarom Crowdfunding</title>
    <link rel="stylesheet" href="css/crowdfunding.css">
    <script src="https://kit.fontawesome.com/d56e6d1e10.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

<div class="hulp-Div">
    <div class="container-Crowdfunding">
        <div class="info-Crowdfunding">
            <h1 class="h1-Crowdfunding">
                Waarom Crowdfunding
            </h1>

            <p>
                Op de afdeling fotografie van het Grafisch Lyceum Rotterdam staat het 2e jaar van de opleiding in het
                teken
                van de eigen ontwikkeling van de student.

                De studenten werken de 2e periode van het 2e jaar van de opleiding aan een eigen project die zal worden
                geëxposeerd tijdens de eind expositie <strong>14 t/m 16 juni</strong> op het Grafisch Lyceum Rotterdam.
            </p>
            <p>
                Professionele afdrukken realiseren is een duur proces. Crowdfunding helpt de student om dit mogelijk te
                maken. Het is voor hen een financiële hulp die het mogelijk maakt om de kosten voor de afdrukken te
                betalen.
                Tevens is het voor hen een mooi en praktisch bruikbaar leerproces wat zij in hun latere beroepspraktijk
                in
                kunnen gaan zetten.
            </p>
            <p>
                Omdat crowdfunding een bekend fenomeen is binnen de fotografie wereld, willen we de studenten hier ook
                kennis mee laten maken.

                De studenten hebben hiervoor zelf een campagne opgezet waarbij ze zichzelf en hun werk promoten. Op de
                <a href="#">deelnemers</a> pagina kunt u de deelnemers aan deze crowdfunding campagne terug vinden.
            </p>
            <p>
                De donateurs ontvangen van de deelnemers waaraan ze doneren een tegenprestatie. De studenten zijn zelf
                verantwoordelijk voor het contact met de donateurs en het leveren van de tegenprestatie.
            </p>
            <p>
                Met een minimale donatie is €5,- aan een deelnemer wordt uw naam toegevoegd aan de lijst met donateurs
                die
                de expositie mogelijk maken. Deze lijst zal tijdens de expositie een prominente plek krijgen.
            </p>
            <p>
                Wilt u doneren klik <a class="a-tag" href="doneren.php">hier</a> voor verdere instructie hoe u kan
                doneren.
            </p>
            <p>
                <strong>Bezoekadres:</strong><br>
                Heer Bokelweg 255 (Hoofdgebouw)<br>
                3032 AD Rotterdam
            </p>
            <p>
                A-gebouw, 2de verdieping <br>
                Lokaal A2.150 en A2.160
            </p>

        </div>

    </div>
</div>
</body>
</html>