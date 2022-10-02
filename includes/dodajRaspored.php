<?php
    session_start();
    
    if(isset($_POST["submit"])){
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';
        $doktor = $_POST["doktor"];
        $datum = $_POST["datum"];
        $vreme = $_POST["vreme"];

        if(emptyRaspored($doktor,$datum,$vreme)){
            header("location:../raspored.php?error=prazanInput");
            exit();
        }

        $serverName = "localhost";
        $dbUsername = "Muhamed";
        $dbPassword = "projekatphp";
        $dbName = "ProjekatPhp";
        $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
        if(!$conn){
            die("Connection failed: ".mysqli_connect_error());
        }
        $sql = "SELECT * FROM raspored WHERE IdDoktora = '$doktor' AND Datum = '$datum' AND Vreme = '$vreme'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo '<script>alert("Termin je zauzet!")</script>';
            echo '<script>window.location.href="../raspored.php";</script>';
        }
        else{
            $sql = "INSERT INTO raspored (IdDoktora,Datum,Vreme) VALUES ('$doktor','$datum','$vreme')";
            if($conn->query($sql) === true){
                echo '<script>alert("Uspešno ste dodali termin!")</script>';
                echo '<script>window.location.href="../raspored.php";</script>';
            }
            else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    else{
        header("location:../raspored.php");
        exit();
    }

