<?php
    $id = $_GET["Id"];

    $serverName = "localhost";
    $dbUsername = "Muhamed";
    $dbPassword = "projekatphp";
    $dbName = "ProjekatPhp";

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    } 

    $sql = "DELETE FROM vesti WHERE Id = $id";

    if($conn->query($sql) === true){
        echo'<script>alert("Uspesno ste izbrisali vest.")</script>';
    }
    else{
        echo "Error deleting record: ".$conn->error;
    }
    header("Location:../profil.php");
    $conn->close();
?>