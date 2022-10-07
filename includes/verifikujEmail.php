<?php  
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if(isset($_POST["submit"])){
        $kod = $_POST["verKod"];
        $jmbg = $_GET["jmbg"];

        if(emptyInput($kod)){
            header("location:../Verifikacija.php?error=emptyInput&jmbg=".$jmbg."");
            exit();
        }
        
        if($kod == PronadjiKod($conn,$jmbg)){
            $sql="UPDATE Pacijent SET Verifikovan = 1 WHERE jmbg = $jmbg";
            if($conn->query($sql) === true){
                header("location: ../login.php?error=uspešnoVerifikovan");
            } 
            else{
                echo "Error updating record: " .$conn->error;
            }
        }
    else{
        header("location: ../Verifikacija.php?error=pogresan&jmbg=".$jmbg."");
        exit();
    }
    }
