<?php
    session_start();
    $idDok = $_GET["id"];
    $imeDok = $_GET["Ime"];
    $prezimeDok = $_GET["Prezime"];
    $idPac = $_SESSION["id"];
    $jmbgPac = $_SESSION["jmbg"];
    $imePac = $_SESSION["ime"];
    $prezimePac = $_SESSION["prezime"];
    $emailPac = $_SESSION["email"];
    $polPac = $_SESSION["pol"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    promeniDoktora($conn,$idDok,$imeDok,$prezimeDok,$idPac,$jmbgPac,$imePac,$prezimePac,$emailPac,$polPac);
