<?php
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

        $username = CreateUserName($conn,$name,$lastname);

        if(emptyInputSignUp($name,$lastname,$gender,$country,$placeOfBirth,$date,$jmbg,$phone,$email,$password,$password2) !== false){
            header("location:../register.php?error=prazanInput");
            exit();
        }
        if(checkName($name) !== true){
            header("location:../register.php?error=nevazeceIme");
            exit();
        }
        if(checkLastName($lastname) !== true){
            header("location:../register.php?error=nevazecePrezime");
            exit();
        }
        if(checkPlace($placeOfBirth) !== true){
            header("location:../register.php?error=nevazeceMesto");
            exit();
        }
        if(checkCountry($country) !== true){
            header("location:../register.php?error=nevazecaDrzava");
            exit();
        }
        if(checkDatee($date) !== true){
            header("location:../register.php?error=nevazeciDatum");
            exit();
        }
        if(strlen($jmbg) !== 13){
            header("location:../register.php?error=nevazeciJMBG");
            exit(); 
        }
        if(CheckJmbgAllBases($conn,$jmbg) === false){
            header("location:../register.php?error=jmbgPostoji");
            exit();
        }
        if(checkPhone($phone) !== true){
            header("location:../register.php?error=nevazeciTelefon");
            exit();
        }
        if(invalidEmail($email) !== false){
            header("location:../register.php?error=nevazeciEmail");
            exit();
        }
        if(pwdMatch($password,$password2) !== false) {
            header("location:../register.php?error=lozinkaX");
            exit();
        }
        if(strlen($password)<8 || strlen($password)>20){
            header("location:../register.php?error=nevazecaDuzina");
            exit(); 
        }

        $img_name=$_FILES['slika']['name'];
        $img_size=$_FILES['slika']['size'];
        $tmp_name=$_FILES['slika']['tmp_name'];
        $error=$_FILES['slika']['error'];
        if($error === 0){
            if($img_size > 625000){
                $em = "Fajl je prevelik!";
                header("Location:../register.php?error= $em");
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
                    $em = "Ne možete da otpremite fajl ovog tipa! Slika mora biti u formatu (jpg,jpeg,png,webp)";
                    header("Location:../register.php?error=$em");   
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
