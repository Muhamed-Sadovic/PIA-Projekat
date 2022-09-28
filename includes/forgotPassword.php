<?php
    require_once "functions.inc.php";
    require_once "dbh.inc.php";

    $email = $_POST["email"];
    $jmbg = $_SESSION["jmbg"];

    //$jmbg=PronadjiJmbg($conn,$email);

    //echo " ".$email;
    //echo " ".$jmbg;

    if(emptyInput($email)){
        header("location:../zaboravljenaLozinka.php?error=emptyinput");
        exit();  
    }
    if(invalidEmail($email) !== false){
        header("location:../zaboravljenaLozinka.php?error=invalidEmail");
        exit();  
    }

    $to = $email;
    $subject = "Zahtev za promenu lozinke";

    $messageee = 
    "<div style=' border: 1px solid grey;width: 340px; height: 350px; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
        <div class='card_header' style='width: 100%; height: 50px; background-color: #75E6DA; padding-left: 5px;padding-top: 2px;'>
            <div class='logo' style='margin-top: 5px; width: 85px; background-color: white; padding: 7px; border-radius: 15px;display:flex; justify-content: center;
            align-items: center;'><b>Med ORL</b>
            </div>
        </div>
        <div style='padding: 10px;'>
            <h3>Dobrodošli u Med ORL!<br></h3>
            <h4>Link ispod vas vodi do stranice gde možete da promenite Vašu lozinku</h4>
            <a href='http://localhost/ProjekatPhp/promeniLozinku.php?jmbg=$jmbg'>Klikni</a>
        </div>
    </div>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <medmedorl121@gmail.com' . "\r\n";
    $headers .= 'Cc: ' . $to . '' . "\r\n";
    $emailSent = sendmail($to,$subject,$messageee,$headers);
    if($emailSent){  
        header("location:../promeniLozinku.php?jmbg=".$jmbg."");
        exit();
    } 
    else{
        echo 'Došlo je do greške! Email nije poslat! Pokušajte ponovo!';
    }
    echo "<script>alert('Poslali ste zahtev za promenu lozinke!')</script>";
    echo "<script>window.location.href='../promeniLozinku.php?Jmbg=".$jmbg."'</script>";