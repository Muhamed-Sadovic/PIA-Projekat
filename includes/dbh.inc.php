<?php
    $serverName = "localhost";
    $dbUsername = "Muhamed";
    $dbPassword = "projekatphp";
    $dbName = "ProjekatPhp";

    $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
