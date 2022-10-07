<?php
    session_start();
    require_once "dbh.inc.php";
    require_once "functions.inc.php";
    require_once "dbh.inc.php";

    $id = $_GET["Id"];
    $idPac = $_SESSION["id"];
    $idDok = $_GET["IdDok"];
    $datum = $_GET["Datum"];
    $vreme = $_GET["Vreme"];

    $sql = "INSERT INTO pregledi (IdDoktora,IdPacijenta,Datum,Vreme) VALUES ('$idDok','$idPac','$datum','$vreme')";
    if($conn->query($sql) === true){
        echo '<script>alert("Uspešno ste zakazali pregled!")</script>';
        echo '<script>window.location.href="../profil.php";</script>';
    }
    else{
        echo "Error: ".$sql."<br>".$conn->error;
    }
    $conn->close();

    $serverName = "localhost";
    $dbUsername = "Muhamed";
    $dbPassword = "projekatphp";
    $dbName = "ProjekatPhp";
    $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql = "DELETE FROM raspored WHERE Id = $id";

    if($conn->query($sql) === true){
        
    }
    else{
        echo "Error deleting record: " . $conn->error; 
    }
    $conn->close();
