<?php

    $id = $_GET["idDok"];
    $jmbg = $_GET["Jmbg"];
    $imeDok = $_GET["ImeDok"];
    $prezimeDok = $_GET["PrezDok"];
    $serverName="localhost";
    $dbUsername="Muhamed";
    $dbPassword="projekatphp";
    $dbName="ProjekatPhp";
    $conn=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }

    $sql = "UPDATE izabranilekar SET IdDoktora = '$id',ImeDoktora = '$imeDok',PrezimeDoktora = '$prezimeDok'  WHERE  JmbgPacijenta ='$jmbg'";    
    if($conn->query($sql) === true) {
        
    }
    else{
        echo "Error deleting record: " . $conn->error;  
    }

    $sql2 = "DELETE FROM promenidoktor WHERE IdDoktora =".$id." AND JmbgPacijenta =".$jmbg."";    
    if($conn->query($sql2) === true) {
        echo'<script>alert("Uspesno ste odobrili zahtev za promenu doktora.")</script>';
        echo '<script>window.location.href="../promenaDoktora.php";</script>';
    }
    else{
        echo "Error deleting record: " . $conn->error;  
    }
?>