<?php

    require_once 'Mailer/class.phpmailer.php';
    require_once 'Mailer/class.smtp.php';

    function emptyInputSignup($name,$lastname,$gender,$country,$placeOfBirth,$date,$jmbg,$phone,$email,$password,$password2){
        $result = true;
        if(empty($name) || empty($lastname) || empty($gender) || empty($country) || empty($placeOfBirth) || empty($date) || empty($jmbg) || empty($phone) 
            || empty($email) || empty($password) || empty($password2)) {
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function CheckName($name){
        if(preg_match('/^([A-ZČĆŽŠĐ][a-zčćžšđ]+)$/',$name)){
            return true;
        }
        else{
            return false;
        }
    }

    function CheckLastName($lastname){
        if(preg_match('/^([A-ZČĆŽŠĐ][a-zčćžšđ]+)$/',$lastname)){
            return true;
        }
        else{
            return false;
        }
    }
    
    function CheckPlace($placeOfBirth){
        if(preg_match('/^([A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}[\s]?)+$/',$placeOfBirth)){
            return true;
        }
        else{
            return false;
        }
    }

    function CheckCountry($country){
        if(preg_match('/^([A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}[\s]?)+$/',$country)){
            return true;
        }
        else{
            return false;
        }
    }

    function CheckDatee($date){
        $gornjaGranica='2004-07-25';
        $donjaGranica='1900-07-25';
        if($gornjaGranica > $date  &&  $donjaGranica < $date){
            return true;
        }
        else{
            return false;
        }
    }

    function jmbgExistsPacijent($conn,$jmbg){
        $sql = "SELECT * FROM pacijent WHERE Jmbg = '$jmbg';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
            return false;
        return true;
    }

    function jmbgExistsDoktor($conn,$jmbg){
        $sql = "SELECT * FROM doktor WHERE Jmbg = '$jmbg';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
            return false;
        return true;
    }

    function jmbgExistsAdmin($conn,$jmbg){
        $sql = "SELECT * FROM adminn WHERE Jmbg = '$jmbg';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
            return false;
        return true;
    }

    function CheckJmbgAllBases($conn,$jmbg){
        if(jmbgExistsDoktor($conn,$jmbg) == false || jmbgExistsPacijent($conn,$jmbg) == false || jmbgExistsAdmin($conn,$jmbg) == false){
            return false;
        }
        else{
            return true;
        }
    }

    function CheckPhone($phone){
        if(preg_match('/^(\d{6,10})$/',$phone)){
            return true;
        }
        else{
            return false;
        }
    }
    
    function InvalidEmail($email){
        if(!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',$email)){
            return true;
        }
        else{
            return false;
        }
    }

    function pwdMatch($password,$password2){
        $result = true;
        if($password!==$password2){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

    function UsernameExist($conn,$username){
        $sql = "SELECT * FROM Pacijent WHERE Username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
            return false;
        return true;
    }

    function CreateUserName($conn,$name,$lastname){
        $random = rand(0,100);
        $username = $name[0].$lastname.$random;
        $a = 1;
            while(UsernameExist($conn, $username) === false){
                $a++;
                $a = strval($a);
                $username .= $a;
            }
            return $username;
    }
    //ynzhvoybyaixtpmd

    function sendmail($to, $subject, $message, $altmess) {
        $from  = "medmedorl121@gmail.com";
        $namefrom = "Muhamed";
        $mail = new PHPMailer();
        $mail->isSMTP();   // by SMTP
        $mail->isHTML();   // by HTML
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth   = "true";   // user and password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->Username   = $from;
        $mail->Password   = "ynzhvoybyaixtpmd";
        $mail->Subject  = $subject;
        $mail->setFrom($from);   // From (origin)
        $mail->Body = $message;
        $mail->addAddress($to);
        return $mail->send();
    }
    
    function createPacijent($conn,$name,$lastname,$gender,$placeOfBirth,$country,$date,$jmbg,$phone,$email,$image,$password,$username){
        $sql = "INSERT INTO Pacijent(Ime,Prezime,Pol,Mesto_rodjenja,Drzava_rodjenja,Datum_rodjenja,Jmbg,Telefon,Email,Slika,Lozinka,Username,Kljuc,Verifikovan)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location:../register.php?error=stmtfailed");
            exit();
        }

        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        
        $key = substr(md5(time().$username),0,10);
        $verified = 0;

        mysqli_stmt_bind_param($stmt,"ssssssssssssss",$name,$lastname,$gender,$placeOfBirth,$country,$date,$jmbg,$phone,$email,$image,$hashedPassword,$username,$key,$verified);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $to = $email;
        $subject = "Verifikacija na Med ORL";

        $messageee = 
        "<div style=' border: 1px solid grey;width: 340px; height: 350px; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
            <div class='card_header' style='width: 100%; height: 50px; background-color: #75E6DA; padding-left: 5px;padding-top: 2px;'>
                <div class='logo' style='margin-top: 5px; width: 85px; background-color: white; padding: 7px; border-radius: 15px;display:flex; justify-content: center;
                align-items: center;'><b>Med ORL</b>
                </div>
            </div>
            <div style='padding: 10px;'>
                <h3>Dobrodosli u Med ORL!<br></h3>
                <h4>Username: ".$username."</h4>
                <h4>Verifikacioni kod: ".$key."</h4>
                <h4>Link ispod vas vodi do stranice gde treba da upisete vaš verifikacioni kod.</h4>
                <a href='http://localhost/ProjekatPhp/Verifikacija.php?jmbg=$jmbg'>Klikni</a>
            </div>
        </div>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <medmedorl121@gmail.com' . "\r\n";
        $headers .= 'Cc: ' . $to . '' . "\r\n";
        $emailSent = sendmail($to,$subject,$messageee,$headers);
        if($emailSent){  
            header("location: ../Verifikacija.php?jmbg=".$jmbg."");
            exit();
        } else {
            echo 'Došlo je do greške! Email nije poslat! Pokušajte ponovo!';
        }
     
        header("location:../Verifikacija.php?jmbg=".$jmbg."");
        exit();
    }

    function createDoktor($conn,$name,$lastname,$gender,$placeOfBirth,$country,$date,$jmbg,$phone,$email,$image,$password,$username,$check){
        $sql = "INSERT INTO doktor(Ime,Prezime,Pol,Mesto_rodjenja,Drzava_rodjenja,Datum_rodjenja,Jmbg,Telefon,Email,Slika,Lozinka,Username,Cekiraj)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("location:../register.php?error=stmtfailed");
                exit();
            }
            $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt,"sssssssssssss",$name,$lastname,$gender,$placeOfBirth,$country,$date,$jmbg,$phone,$email,$image,$hashedPassword,$username,$check);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header("location:../zahtevZaDoktora.php?error=none");
            exit();
    }

    function createArternativeDoktor($conn,$name,$lastname,$jmbg,$email,$placeOfBirth,$gender){
        $sql = "INSERT INTO zahtevzadoktora(Ime,Prezime,Jmbg,Email,Mesto_rodjenja,Pol) VALUES (?,?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location:../register.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssssss",$name,$lastname,$jmbg,$email,$placeOfBirth,$gender);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location:../zahtevZaDoktora.php?error=none");
        exit();
    }

    //Za VERIFIKACIJU

    function PronadjiKod($conn,$jmbg){
        $sql="SELECT Kljuc FROM pacijent WHERE Jmbg = ?;";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $jmbg);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            return $row["Kljuc"];
        }
        $conn->close();
    }
    
    function emptyInput($kod){
        $result = true;
        if(empty($kod)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    /// ZA LOGIN!!!!!!!!!!!!!!!!!!!!!!!!1

    function emptyInputLogin($username,$password){
        $result = true;
        if(empty($username) || empty($password)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    

    function uidExists($conn,$username){
        $sql = "SELECT * FROM pacijent WHERE (Username = '$username' OR Email = '$username');";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            return $user;
        }
        $sql2 = "SELECT * FROM doktor WHERE Username = '$username' OR Email = '$username';";
        $result2 = $conn->query($sql2);
        if($result2->num_rows > 0){
            $user = $result2->fetch_assoc();
            return $user;
        }   
        $sql3 = "SELECT * FROM adminn WHERE Username = '$username' OR Email = '$username';";
        $result3 = $conn->query($sql3);
        if($result3->num_rows > 0){
            $user = $result3->fetch_assoc();
            return $user;
        }     
        return 0;
    }

    // function adminSifra($conn,$password){
    //     $sql = "SELECT * FROM 'admin' WHERE Lozinka = '$password'";
    //     $result = $conn->query($sql);
    //     $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
    // }

    function loginUser($conn,$username,$password){
        $uidExist = uidExists($conn,$username);

        if($uidExist == 0){
            header("location:../login.php?error=pogresanInput");
            exit();
        }

        $passwordHashed = $uidExist["Lozinka"];
        $checkPassword = password_verify($password,$passwordHashed);
        //LOGIN PACIJENTA

        $sql = "SELECT * FROM pacijent WHERE Username='$username' OR Email ='$username';";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $verifiedStatus = $row['Verifikovan'];
            }   
            if($checkPassword === false){
                header("location:../login.php?error=pogresanInput");
                exit();
            }
            $verifiedStatus = $uidExist["Verifikovan"];
            if($verifiedStatus != 1){
                header("location:../login.php?error=nijeVerifikovan");
                exit();
            }  
        }
        
        //LOGIN DOKTORA 

        $sql2 = "SELECT * FROM doktor WHERE Username='$username' OR Email ='$username';";
        $result = $conn->query($sql2);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $checkStatus = $row['Cekiraj'];
            }
            if($checkPassword === false){
                header("location:../login.php?error=pogresanInput");
                exit();
            }
            $checkStatus = $uidExist["Cekiraj"];
            if($checkStatus != 1){
                header("location:../login.php?error=nijeOdobren");
                exit();
            } 
        }

        if($checkPassword === true){
           session_start();
           $_SESSION["id"] = $uidExist["Id"];
           $_SESSION["ime"] = $uidExist["Ime"];
           $_SESSION["prezime"] = $uidExist["Prezime"];
           $_SESSION["pol"] = $uidExist["Pol"];
           $_SESSION["mesto_rodjenja"] = $uidExist["Mesto_rodjenja"];
           $_SESSION["drzava_rodjenja"] = $uidExist["Drzava_rodjenja"];
           $_SESSION["datum_rodjenja"] = $uidExist["Datum_rodjenja"];
           $_SESSION["jmbg"] = $uidExist["Jmbg"];
           $_SESSION["telefon"] = $uidExist["Telefon"];
           $_SESSION["email"] = $uidExist["Email"];
           $_SESSION["username"] = $uidExist["Username"];
           header("location:../profil.php");
           exit();
        }
    }

    //PROFILLLL!!!!!!!!!!!!!!!!!!!!!!!!!11

    function proveriPacijenta($conn,$id){
        $sql = "SELECT * FROM pacijent WHERE Id = '$id';";
        $result = $conn->query($sql);  //VRSI UPIT PREMA BAZI PODATAKA
        if($result->num_rows > 0){     
            $user = $result->fetch_assoc();  //преузима ред резултата као асоцијативни низ.
            return $user;
        }
    }
    function proveriDoktora($conn,$id){
        $sql = "SELECT * FROM doktor WHERE Id = '$id';";
        $result = $conn->query($sql);  //VRSI UPIT PREMA BAZI PODATAKA
        if($result->num_rows > 0){     
            $user = $result->fetch_assoc();  //преузима ред резултата као асоцијативни низ.
            return $user;
        }
    }
    function proveriAdmina($conn,$id){
        $sql = "SELECT * FROM adminn WHERE Id = '$id';";
        $result = $conn->query($sql);  //VRSI UPIT PREMA BAZI PODATAKA
        if($result->num_rows > 0){     
            $user = $result->fetch_assoc();  //преузима ред резултата као асоцијативни низ.
            return $user;
        }
    }

    //SLIKAAAAAAAAA

    function PronadjiSlikuPac($conn,$id){
        $sql="SELECT Slika FROM pacijent WHERE Id = ?;";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $pac = $row['Slika'];
            return $pac;
        }
    }
    function PronadjiSlikuDok($conn,$id){
        $sql="SELECT Slika FROM doktor WHERE Id = ?;";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $dok = $row['Slika'];
            return $dok;
        }
    }
    

    //ZA NOVOSTI

    function emptyInputVest($naslov,$tekst){
        if(empty($naslov) || empty($tekst)){
            return false;
        }
        else{
            return true;
        }
    }

    function checkNaslov($naslov){
        if(strlen($naslov)>40 && strlen($naslov)<100){
            return true;
        }
        else{
            return false;
        }
    }
    function checkTekst($tekst){
        if(strlen($tekst)>300 && strlen($tekst)<1200){
            return true;
        }
        else{
            return false;
        }
    }
    function createVest($conn,$naslov,$tekst,$slika,$ime,$idK){
        $sql = "INSERT INTO vesti(Naslov,Tekst,Slika,KreatorIme,IdKreatora) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location:../dodajVest.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sssss",$naslov,$tekst,$slika,$ime,$idK);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location:../dodajVest.php?error=uspesnoDodana");
        exit();
    }

    //ZA PROMENU PODATAKA
    function emptyInputChangeData($email,$username,$password){
        if(empty($email) || empty($username) || empty($password)){
            return false;
        }
        else{
            return true;
        }
    }
    function changeUsername($username){
        if(preg_match('/^([A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}[0-9]{1,10})+$/',$username)){
            return true;
        }
        else{
            return false;
        }
    }

    function IzabraniDoktor($conn,$idDok,$imeDok,$prezimeDok,$idPac,$jmbgPac,$imePac,$prezimePac,$emailPac,$polPac){
        $sql="INSERT INTO izabranilekar (IdDoktora,ImeDoktora,PrezimeDoktora,IdPacijenta,JmbgPacijenta,ImePacijenta,PrezimePacijenta,EmailPacijenta,PolPacijenta) VALUES(?,?,?,?,?,?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location:../register.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sssssssss",$idDok,$imeDok,$prezimeDok,$idPac,$jmbgPac,$imePac,$prezimePac,$emailPac,$polPac);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo '<script>alert("Uspešno ste izabrali doktora!")</script>';
        echo '<script>window.location.href="../profil.php";</script>';
        exit();
    }
    
    function promeniDoktora($conn,$idDok,$imeDok,$prezimeDok,$idPac,$jmbgPac,$imePac,$prezimePac,$emailPac,$polPac){
        $sql="INSERT INTO promenidoktor (IdDoktora,ImeDoktora,PrezimeDoktora,IdPacijenta,JmbgPacijenta,ImePacijenta,PrezimePacijenta,EmailPacijenta,PolPacijenta) VALUES(?,?,?,?,?,?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location:../register.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sssssssss",$idDok,$imeDok,$prezimeDok,$idPac,$jmbgPac,$imePac,$prezimePac,$emailPac,$polPac);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo '<script>alert("Uspešno ste poslali zahtev za promenu lekara!Admin tim će vas putem maila blagovremeno obavestiti.")</script>';
        echo '<script>window.location.href="../profil.php";</script>';
    }