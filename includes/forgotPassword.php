<?php
    require_once "functions.inc.php";
    require_once "dbh.inc.php";
    require_once 'Mailer/class.phpmailer.php';
    require_once 'Mailer/class.smtp.php';

    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = randomPassword();

        if(emptyInput($email)){
            header("location:../zaboravljenaLozinka.php?error=emptyInput");
            exit();  
        }
        if(invalidEmail($email) !== false){
            header("location:../zaboravljenaLozinka.php?error=invalidEmail");
            exit();  
        }
        if(EmailExist($conn,$email) === false){
            header("location:../zaboravljenaLozinka.php?error=existNotEmail");
            exit();
        }

        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

        if(EmailExistAdm($conn,$email)){
            $sql = "UPDATE adminn SET Lozinka = '$hashedPassword' WHERE Email = '$email'";
            if($conn->query($sql) === true){
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
                        <h4>Uspesno ste podneli zahtev za promenu lozinke</h4>
                        <h4>Vaša nova lozinka je: $password</h4>
                        <h4>Link ispod vas vodi do stranice gde možete da se prijavite</h4>
                        <a href='http://localhost/ProjekatPhp/login.php'>Klikni</a>
                    </div>
                </div>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <medmedorl121@gmail.com' . "\r\n";
                $headers .= 'Cc: ' . $to . '' . "\r\n";
                $emailSent = sendmail($to,$subject,$messageee,$headers);
                if($emailSent){  
                    echo '<script>window.location.href="../zahtevZaPromenuLozinke.php";</script>';
                    exit();
                } 
                else{
                    echo 'Došlo je do greške! Email nije poslat! Pokušajte ponovo!';
                }
            }
            else{
                echo "Error updating record: " .$conn->error;
            }
        }



        else if(EmailExistDok($conn,$email)){
            $sql = "UPDATE doktor SET Lozinka = '$hashedPassword' WHERE Email = '$email'";
            if($conn->query($sql) === true){
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
                        <h4>Uspesno ste podneli zahtev za promenu lozinke</h4>
                        <h4>Vaša nova lozinka je: $password</h4>
                        <h4>Link ispod vas vodi do stranice gde možete da se prijavite</h4>
                        <a href='http://localhost/ProjekatPhp/login.php'>Klikni</a>
                    </div>
                </div>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <medmedorl121@gmail.com' . "\r\n";
                $headers .= 'Cc: ' . $to . '' . "\r\n";
                $emailSent = sendmail($to,$subject,$messageee,$headers);
                if($emailSent){  
                    echo '<script>window.location.href="../zahtevZaPromenuLozinke.php";</script>';
                    exit();
                } 
                else{
                    echo 'Došlo je do greške! Email nije poslat! Pokušajte ponovo!';
                }
            }
            else{
                echo "Error updating record: " .$conn->error;
            }
        }




        else if(EmailExistPac($conn,$email)){
            $sql = "UPDATE pacijent SET Lozinka = $hashedPassword WHERE Email = $email";
            if($conn->query($sql) === true){
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
                        <h4>Uspesno ste podneli zahtev za promenu lozinke</h4>
                        <h4>Vaša nova lozinka je: $password</h4>
                        <h4>Link ispod vas vodi do stranice gde možete da se prijavite</h4>
                        <a href='http://localhost/ProjekatPhp/login.php'>Klikni</a>
                    </div>
                </div>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <medmedorl121@gmail.com' . "\r\n";
                $headers .= 'Cc: ' . $to . '' . "\r\n";
                $emailSent = sendmail($to,$subject,$messageee,$headers);
                if($emailSent){  
                    echo '<script>window.location.href="../zahtevZaPromenuLozinke.php";</script>';
                    exit();
                } 
                else{
                    echo 'Došlo je do greške! Email nije poslat! Pokušajte ponovo!';
                }
            }
            else{
                echo "Error updating record: " .$conn->error;
            }
        }
    }
    else{
        echo '<script>window.location.href="../zaboravljenaLozinka.php";</script>';
    }