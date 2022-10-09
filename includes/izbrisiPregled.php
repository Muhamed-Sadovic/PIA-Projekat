<?php
    require_once 'functions.inc.php';
    require_once "dbh.inc.php";

    $idPac = $_GET["IdPac"];
    $datum = $_GET["Datum"];
    $vreme = $_GET["Vreme"];

    $sql = "DELETE FROM pregledi WHERE IdPacijenta = '$idPac' AND Datum = '$datum' AND Vreme = '$vreme'";

    if($conn->query($sql) === true){
        echo "<script>Uspešno ste izbrisali pregled.</script>";
        echo '<script>window.location.href="../pregledSvihPacijenata.php";</script>';
    }
    else{
        echo "Error deleting record: ".$conn->error; 
    }
    $conn->close();
