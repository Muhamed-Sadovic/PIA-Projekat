<?php
    require_once 'Mailer/class.phpmailer.php';
    require_once 'Mailer/class.smtp.php';
    require_once 'functions.inc.php';

    $id = $_GET["Id"];
    $email = $_GET["Email"];

    $serverName = "localhost";
    $dbUsername = "Muhamed";
    $dbPassword = "projekatphp";
    $dbName = "ProjekatPhp";
    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    } 

    $sql2 = "DELETE FROM izabranidoktor WHERE IdDoktora = $id";
    if($conn->query($sql2) === true){

    }
    else{
        echo "Error deleting record: ".$conn->error; 
    }

    $sql = "DELETE FROM doktor WHERE Id = $id";

    if($conn->query($sql) === true){
        $to = $email;
        $subject = "Obavestenje";
        $messageee = 
            "<div style=' border: 1px solid grey;width: 340px; height: 350px; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
                <div class='card_header' style='width: 100%; height: 50px; background-color: #75E6DA; padding-left: 5px;padding-top: 2px;'>
                    <div class='logo' style='margin-top: 5px; width: 85px; background-color: white; padding: 7px; border-radius: 15px;display:flex; justify-content: center;
                    align-items: center;'><b>Med ORL</b>
                    </div>
                </div>
                <div style='padding: 10px;'>
                    <h4>Nažalost, nalog Vam je izbrisan.</h4>
                    <h4>Javite se na mailu za više informacija.</h4>
                </div>
            </div>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <medmedorl121@gmail.com' . "\r\n";
        $headers .= 'Cc: ' . $to . '' . "\r\n";
        $emailSent = sendmail($to,$subject,$messageee,$headers);
        if($emailSent){  
            echo '<script>alert("Uspešno ste obrisali doktora.")</script>';
            echo '<script>window.location.href="../korisnici.php";</script>';
            exit();
        } 
        else{
            echo 'Došlo je do greške! Email nije poslat! Pokušajte ponovo!';
        }
    }
    else{
        echo "Error deleting record: ".$conn->error;  
    }    
?>