<?php

include './inc/auth.php';
$Auth = new modAuth();

include './inc/graph.php';

include "config.php";


$result = mysqli_query($mysqli, "SELECT email FROM admin WHERE email = '$Auth->userName'");
while ($row = $result->fetch_assoc()) {
    //array_push($admin, $row['email']);
    $admin = $row['email'];
}

if ($Auth->userName == $admin) {
    $_SESSION['gebruiker'] = $Auth->userName;
    $_SESSION['isIngelogd'] = true;
    echo $_SESSION['gebruiker'] . '<br>';
    //header('Location: overzicht.php');
    echo "Je bent een admin";
} else {
    echo "Je bent geen admin";
}

if ($Auth->userName === $admin) {
    header('Location: beheerPagina.php');
} else {
    header('Location: profiel.php');
}

