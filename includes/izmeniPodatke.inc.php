<?php
    session_start();
    require_once "functions.inc.php";
    require_once "dbh.inc.php";

    if(isset($_POST["submit"])){
        $id = $_SESSION["id"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["lozinka"];
        $password2 = $_POST["potvrda_lozinke"];

        if(emptyInputChangeData($email,$username,$password,$password2) === false){
            header("location:../izmeniPodatke.php?error=prazanInput");
            exit();
        }
        if(InvalidEmail($email) !== false){
            header("location:../izmeniPodatke.php?error=nevazeciEmail");
            exit();
        }
        if(changeUsername($username) === false){
            header("location:../izmeniPodatke.php?error=nevazeciUsername");
            exit();
        }
        if(UsernameExist($conn,$username) === true){
            header("location:../izmeniPodatke.php?error=usernamePostoji");
            exit();
        }
        if(pwdMatch($password,$password2) !== false){
            header("location:../izmeniPodatke.php?error=lozinkaX");
            exit();
        }
        if(strlen($password)<8 || strlen($password)>20){
            header("location:../izmeniPodatke.php?error=nevazecaDuzina");
            exit(); 
        }

        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

        if(proveriAdmina($conn,$id)){
            $sql = "UPDATE adminn SET Email = '$email',Lozinka = '$hashedPassword',Username = '$username' WHERE Id=$id";
            if ($conn->query($sql) === true) {
                header("location:../izmeniPodatke.php?success=uspesnoPronenjeniPodaci");
                exit();               
            } 
            else{
                echo "Error updating record: ". $conn->error;
            }
        }
        if(proveriDoktora($conn,$id)){
            $sql = "UPDATE doktor SET Email = '$email',Lozinka = '$hashedPassword',Username= '$username' WHERE Id=$id";
            if ($conn->query($sql) === true) {
                header("location:../izmeniPodatke.php?success=uspesnoPronenjeniPodaci");
                exit();   
            } 
            else{
                echo "Error updating record: ". $conn->error;
            }
        }
        if(proveriPacijenta($conn,$id)){
            $sql = "UPDATE izabranidoktor SET EmailPacijenta = '$email' WHERE IdPacijenta = $id";
            if($conn->query($sql) === true){
               
            } 
            else{
                echo "Error updating record: ". $conn->error;
            }

            $sql2 = "UPDATE pacijent SET Email = '$email',Lozinka = '$hashedPassword',Username = '$username' WHERE Id = $id ";
            if ($conn->query($sql2) === true) {
                header("location:../izmeniPodatke.php?success=uspesnoPronenjeniPodaci");
                exit();               
            } 
            else{
                echo "Error updating record: ". $conn->error;
            }
        }
    }
    else{
        header("location:../izmeniPodatke.php");
        exit();
    }
?>