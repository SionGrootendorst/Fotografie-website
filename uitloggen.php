<?php
// Inladen van de auth module. Dit zal ons redirecten naar de loginpagina van Microsoft indien we niet ingelogd zijn.
include './inc/auth.php';
$Auth = new modAuth();

// Inladen van de graph module. Deze zal informatie ophalen vanuit de Microsoft Graph API. https://aka.ms/ge
include './inc/graph.php';
$Graph = new modGraph();

// Profielfoto en basic profile informatie ophalen.
$photo = $Graph->getPhoto();
$profile = $Graph->getProfile();
