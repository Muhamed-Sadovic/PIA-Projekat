<?php
    session_start();  
    if(isset($_POST["submit"])){
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';
        $doktor = $_POST["doktor"];
        $datum = $_POST["datum"];
        $vreme = $_POST["vreme"];
        $danasnjiDatum = date('Y/m/d');
        $today = strtotime($danasnjiDatum);
        $termin = strtotime($datum);

        if(emptyRaspored($doktor,$datum,$vreme)){
            header("location:../raspored.php?error=prazanInput");
            exit();
        }
        if($today > $termin){
            header("location:../raspored.php?error=invalidDatum");
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

