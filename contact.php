<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/contact.css">
    <script src="https://kit.fontawesome.com/d56e6d1e10.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">
    <title>Contact</title>
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


<div class="container-Contact">
    <div class="hulp-Div">
        <div class="info-Contact">
            <h1 class="h1-Contact">Contact</h1>
            <p>
                Heeft u vragen m.b.t. de crowdfunding, opmerkingen of suggesties dan kunt u contact opnemen via
                onderstaand
                emailadres.
            </p>
            <p>
                <strong>Email</strong> <br>
                <a href="mailto:bruining@glr.nl">bruining@glr.nl</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>