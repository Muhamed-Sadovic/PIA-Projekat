<?php
    session_start();
    if(isset($_POST["submit"])){
        require_once "dbh.inc.php";
        require_once "functions.inc.php";

        $dijagnoza = $_POST["dijagnoza"];
        $lecenje = $_POST["lecenje"];
        $idDok = $_SESSION["id"];
        $idPac = $_GET["Id"];
        $datum = $_GET["Datum"];
        $vreme = $_GET["Vreme"];

        $serverName = "localhost";
        $dbUsername = "Muhamed";
        $dbPassword = "projekatphp";
        $dbName = "ProjekatPhp";
        $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
        if(!$conn){
            die("Connection failed: ".mysqli_connect_error());
        }
        $sql = "INSERT INTO karton (IdPacijenta,IdDoktora,Dijagnoza,Lecenje,Datum,Vreme) VALUES ('$idPac','$idDok','$dijagnoza','$lecenje','$datum','$vreme')";
        if($conn->query($sql) === true){
            echo '<script>alert("Uspešno ste popunili karton")</script>';
            echo '<script>window.location.href="../profil.php";</script>';
        }
        else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

    }