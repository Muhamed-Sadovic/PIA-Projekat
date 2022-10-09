<?php
    session_start();
    if(isset($_POST["submit"])){
        require_once "dbh.inc.php";
        require_once "functions.inc.php";

        $dijagnoza = $_POST["dijagnoza"];
        $lecenje = $_POST["lecenje"];
        $idDok = $_SESSION["id"];
        $idPac = $_GET["IdPac"];
        $datum = $_GET["Datum"];
        $vreme = $_GET["Vreme"];

        if(emptyKarton($dijagnoza,$lecenje)){
            header("location:../obaviPregled.php?error=prazanInput&IdPac=".$idPac."&Datum=".$datum."&Vreme=".$vreme."");
            exit();
        }
        if(checkDijagnoza($dijagnoza) === false){
            header("location:../obaviPregled.php?error=nevazecaDijagnoza&IdPac=".$idPac."&Datum=".$datum."&Vreme=".$vreme."");
            exit();
        }
        if(checkLecenje($lecenje) === false){
            header("location:../obaviPregled.php?error=nezaveceLecenje&IdPac=".$idPac."&Datum=".$datum."&Vreme=".$vreme."");
            exit();
        }

        $sql2 = "DELETE FROM pregledi WHERE IdPacijenta = '$idPac' AND Datum = '$datum' AND Vreme = '$vreme'";
        if($conn->query($sql2) === true){

        }
        else{
            echo "Error: ". $sql2 . "<br>" . $conn->error;
        }

        $sql = "INSERT INTO karton (IdPacijenta,IdDoktora,Dijagnoza,Lecenje,Datum,Vreme) VALUES ('$idPac','$idDok','$dijagnoza','$lecenje','$datum','$vreme')";
        if($conn->query($sql) === true){
            echo '<script>alert("Uspešno ste popunili karton")</script>';
            echo '<script>window.location.href="../zakazaniPregledi.php";</script>';
        }
        else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        header("location:../obaviPregled.php");
        exit();  
    }

    