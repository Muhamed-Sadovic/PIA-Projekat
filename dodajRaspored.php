<?php
    session_start();
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $doktor = $_POST["doktor"];
    $datum = $_POST["datum"];
    $vreme = $_POST["vreme"];

    if(emptyRaspored($doktor,$datum,$vreme)){
        header("location:../raspored.php?error=prazanInput");
        exit();
    }
    if(emptyInputDoktor($doktor)){
        header("location:../raspored.php?error=izaberiDoktora");
        exit();
    }
    if(emptyInputVreme($vreme)){
        header("location:../raspored.php?error=izaberiVreme");
        exit();
    }

