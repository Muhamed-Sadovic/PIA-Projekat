<?php
    $id = $_GET["Id"];
    require_once "functions.inc.php";
    require_once "dbh.inc.php";

    $sql = "DELETE FROM vesti WHERE Id = $id";

    if($conn->query($sql) === true){
        echo'<script>alert("Uspešno ste izbrisali vest.")</script>';
    }
    else{
        echo "Error deleting record: ".$conn->error;
    }
    header("Location:../profil.php");
    $conn->close();