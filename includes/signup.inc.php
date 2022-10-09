<?php
    error_reporting(0);
    if(isset($_POST["submit"])){
        $name = $_POST["ime"];
        $lastname = $_POST["prezime"];
        $gender = $_POST["pol"];
        $placeOfBirth = $_POST["mesto"];
        $country = $_POST["drzava"];
        $date = $_POST["datum"];
        $jmbg = $_POST["jmbg"];
        $phone = $_POST["telefon"];
        $email = $_POST["email"];
        $password = $_POST["lozinka"];
        $password2 = $_POST["potvrda_lozinke"];
        $check = $_POST["doktor"];
        
        require_once 'functions.inc.php';
        require_once 'dbh.inc.php';

        if(emptyInputSignUp($name,$lastname,$gender,$country,$placeOfBirth,$date,$jmbg,$phone,$email,$password,$password2) !== false){
            echo'<script>alert("Popunite sva polja")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(checkName($name) !== true){
            echo'<script>alert("Ime mora početi velikim slovom")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(checkLastName($lastname) !== true){
            echo'<script>alert("Prezime mora početi velikim slovom")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(checkPlace($placeOfBirth) !== true){
            echo'<script>alert("Grad mora početi velikim slovom")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(checkCountry($country) !== true){
            echo'<script>alert("Država mora početi velikim slovom")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(checkDatee($date) !== true){
            echo'<script>alert("Morate imati iznad 18 godina")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(strlen($jmbg) !== 13){
            echo'<script>alert("JMBG mora imati tačno 13 cifara")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit(); 
        }
        if(CheckJmbgAllBases($conn,$jmbg) === false){
            echo'<script>alert("Ovaj korisnik već postoji")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(checkPhone($phone) !== true){
            echo'<script>alert("Telefon mora imati 6-10 brojeva")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(invalidEmail($email) !== false){
            echo'<script>alert("Email nije u ispravnom formatu")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(pwdMatch($password,$password2) !== false){
            echo'<script>alert("Šifre se ne poklapaju")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit();
        }
        if(strlen($password)<8 || strlen($password)>20){
            echo'<script>alert("Šifra mora imati izmedju 8 i 20 karaktera")</script>';
            echo '<script>window.location.href="../register.php";</script>';
            exit(); 
        }

        $username = CreateUserName($conn,$name,$lastname);

        $img_name=$_FILES['slika']['name'];
        $img_size=$_FILES['slika']['size'];
        $tmp_name=$_FILES['slika']['tmp_name'];
        $error=$_FILES['slika']['error'];
        if($error === 0){
            if($img_size > 625000){
                $em = "Fajl je prevelik!";
                echo'<script>alert("Fajl je prevelik!")</script>';
                echo '<script>window.location.href="../register.php";</script>';
            }
            else{
                $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg","jpeg","png","webp");
                if(in_array($img_ex_lc,$allowed_exs)){
                    $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                    $img_upload_path='../slike/'.$new_img_name;
                    move_uploaded_file($tmp_name,$img_upload_path);
                    if($check == true){
                        createDoktor($conn,$name,$lastname,$gender[0],$placeOfBirth,$country,$date,$jmbg,$phone,$email,$new_img_name,$password,$username,$check);
                    }
                    else{
                        createPacijent($conn,$name,$lastname,$gender[0],$placeOfBirth,$country,$date,$jmbg,$phone,$email,$new_img_name,$password,$username);
                    }
                }
                else{
                    echo'<script>alert("Ne možete da otpremite fajl ovog tipa! Slika mora biti u formatu (jpg,jpeg,png,webp)")</script>';
                    echo '<script>window.location.href="../register.php";</script>';   
                }
            }
        }
        else{
            $im ="";
            if($check == true){
                createDoktor($conn,$name,$lastname,$gender[0],$placeOfBirth,$country,$date,$jmbg,$phone,$email,$im,$password,$username,$check);
            }
            else{
                createPacijent($conn,$name,$lastname,$gender[0],$placeOfBirth,$country,$date,$jmbg,$phone,$email,$im,$password,$username);
            }       
        }  
    }
    else{
        echo '<script>window.location.href="../register.php";</script>';
        exit();
    }
