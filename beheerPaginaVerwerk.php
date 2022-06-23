<?php
require 'config.php';

if (isset($_POST['IDJa'])) {
    $id = $_POST['IDJa'];

    $query = "UPDATE profiel";
    $query .= " SET goedgekeurd = 'ja'";
    $query .= " WHERE ID=" . $id;

    $result = mysqli_query($mysqli, $query);

    if ($result) {
        echo "item is goedgekeurd";
    } else {
        echo "FOUT bij toevoegen<br/>";
        echo $query . "<br/>"; //Tijdelijk (!) de query tonen
        echo mysqli_error($mysqli); //Tijdelijk (!) de foutmelding tonen
    }
}

if (isset($_POST['IDNee'])) {
    $id = $_POST['IDNee'];



    $result = mysqli_query($mysqli, "SELECT * FROM profiel WHERE id = $id");

    $data = [];
    $data2 = [];
    $email = '';

    while($row = mysqli_fetch_array($result)) {
        $email = $row['email'];

        $std = str_replace("@glr.nl", "", $email);

        $query = "DELETE FROM profiel WHERE ID = " . $id;
//    $query2 = "DELETE FROM tegenprestatie WHERE studentnummer =" . $studentnummer;
        $query2 = "DELETE FROM tegenprestatie WHERE studentnummer= $std";
        mysqli_query($mysqli, "DELETE FROM donaties WHERE email_student = '$email'");
        $queryFoto = "DELETE FROM fotos WHERE studentnummer = $std";
        $result = mysqli_query($mysqli, $query);
        $result2 = mysqli_query($mysqli, $query2);

        $resultFoto = mysqli_query($mysqli, $queryFoto);


        $status = unlink("./profiel_foto/" . $std . ".png");
        if ($status) {
            echo "";
        } else {
            echo "Er is iets fout gegaan.";
        }

        for ($i = 0; $i <= 2; $i++) {
            $status2 = unlink("./fotos/" . $std . "_" . $i . ".png");
            if ($status2) {
                echo "";
            } else {
                echo "Er is iets fout gegaan.";
            }
        }
    }

    echo $id;

}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $id = str_replace('(', '', $id);
    $id = str_replace(')', '', $id);
    $result = mysqli_query($mysqli, "SELECT * FROM profiel WHERE id = $id AND goedgekeurd = 'neutraal'");

    $data = [];

    while($row = mysqli_fetch_array($result)) {

        $data = $row;

        //tegenprestatie
        $email = $row['email'];
        $std = str_replace("@glr.nl", "", $email);
        $result = mysqli_query($mysqli, "SELECT tegenprestatie, bedrag FROM tegenprestatie WHERE studentnummer = $std");

        $i = 0;

        while($row = mysqli_fetch_array($result)) {

            $data['tegenprestaties'][$i] = $row;
            $i++;
        }

        //fotos
        $result = mysqli_query($mysqli, "SELECT foto FROM fotos WHERE studentnummer = $std");

        $j = 0;

        while($row = mysqli_fetch_array($result)) {

            $data['fotos'][$j] = $row;
            $j++;
        }

    }
//    echo json_encode($data2);
    echo json_encode($data);


}

if (isset($_POST['allDonations'])) {
    $result = mysqli_query($mysqli, "SELECT * FROM donaties");

    $data = [];

    $i = 0;
    while($row = mysqli_fetch_array($result)) {
        $data[$i] = $row;
        $i++;
    }

    echo json_encode($data);
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $email = str_replace('(', '', $email);
    $email = str_replace(')', '', $email);

    $result = mysqli_query($mysqli, "SELECT * FROM donaties WHERE email_student = '$email'");

    $data = [];
    $i = 0;
    while($row = mysqli_fetch_array($result)) {
        $data[$i] = $row;
        $i++;
    }

    echo json_encode($data);
}

if (isset($_POST['idProfiel'])) {
    $id = $_POST['idProfiel'];
    $id = str_replace('(', '', $id);
    $id = str_replace(')', '', $id);
    $result = mysqli_query($mysqli, "SELECT * FROM profiel WHERE id = $id");

    $data = [];

    while($row = mysqli_fetch_array($result)) {

        $data = $row;

        //tegenprestatie
        $email = $row['email'];
        $std = str_replace("@glr.nl", "", $email);
        $result = mysqli_query($mysqli, "SELECT tegenprestatie, bedrag FROM tegenprestatie WHERE studentnummer = $std");

        $i = 0;

        while($row = mysqli_fetch_array($result)) {

            $data['tegenprestaties'][$i] = $row;
            $i++;
        }

        //fotos
        $result = mysqli_query($mysqli, "SELECT foto FROM fotos WHERE studentnummer = $std");

        $j = 0;

        while($row = mysqli_fetch_array($result)) {

            $data['fotos'][$j] = $row;
            $j++;
        }

    }
//    echo json_encode($data2);
    echo json_encode($data);
}


if (isset($_POST['deleteID'])) {

    $id = $_POST['deleteID'];

    $result = mysqli_query($mysqli, "SELECT * FROM donaties WHERE id = $id");


    while($row = mysqli_fetch_array($result)) {

        $email = $row['email_student'];
        $bedrag = $row['bedrag'];

        //Bedrag op student pagina updaten met bedrag van donateur
        $queryStorten = "SELECT gedoneerd FROM profiel WHERE email = '$email'";
        $resultStorten = mysqli_query($mysqli, $queryStorten);
        if ($rowSort = mysqli_fetch_array($resultStorten)) {
            $gedoneerdBedrag = $rowSort['gedoneerd'];

            //Het huidige bedrag plus het gedoneerde bedrag doen
            $nieuweBedrag = $gedoneerdBedrag - $bedrag;

            $sql = "UPDATE profiel SET gedoneerd = $nieuweBedrag WHERE email = '$email'";

            if (mysqli_query($mysqli, $sql)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($mysqli);
            }
            mysqli_query($mysqli, "DELETE FROM donaties WHERE id = $id");
        }

    }
}

if (isset($_POST['b_email'])) {


    $naam = $_POST['b_naam'];
    $email = $_POST['b_email'];

    mysqli_query($mysqli, "INSERT INTO admin (email, naam) VALUES ('$email', '$naam')");
}