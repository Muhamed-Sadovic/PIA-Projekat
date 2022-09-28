<?php
    require_once "functions.inc.php";
    require_once "dbh.inc.php";

    $password = $_POST["lozinka"];
    $password2 = $_POST["lozinka2"];

    if(emptyInputPassword($password,$password2) === true){
        header("location:../promeniLozinku.php?error=prazanInput");
        exit();  
    }
    if(pwdMatch($password,$password2)){
        header("location:../promeniLozinku.php?error=lozinkaX");
        exit();  
    }

    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);