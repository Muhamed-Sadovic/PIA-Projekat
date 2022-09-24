<?php

    $id = $_GET["idDok"];
    $jmbg = $_GET["Jmbg"];
    $serverName="localhost";
    $dbUsername="Muhamed";
    $dbPassword="projekatphp";
    $dbName="ProjekatPhp";
    $conn=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }

    $sql = "DELETE FROM promenidoktor WHERE IdDoktora =".$id." AND JmbgPacijenta =".$jmbg."";    
    if($conn->query($sql) === TRUE) {
        echo'<script>alert("Uspesno ste odbili zahtev za promenu doktora.")</script>';
        echo '<script>window.location.href="../promenaDoktora.php";</script>';
    }
    else{
        echo "Error deleting record: " . $conn->error;  
    }


?>