<?php
    session_start();

    require_once "functions.inc.php";
    require_once "dbh.inc.php";

    $naslov = $_POST["naslov"];
    $tekst = $_POST["tekst"];
    $ime = $_SESSION["ime"].' '.$_SESSION["prezime"];
    $idK = $_SESSION["id"];

    if(emptyInputVest($naslov,$tekst) === false){
        header("location:../dodajVest.php?error=prazanInput");
        exit();
    }
    if(checkNaslov($naslov) === false){
        header("location:../dodajVest.php?error=nevazeciNaslov");
        exit();
    }
    if(checkTekst($tekst) === false){
        header("location:../dodajVest.php?error=nevazeciTekst");
        exit();
    }

    $img_name=$_FILES['slika']['name'];
    $img_size=$_FILES['slika']['size'];
    $tmp_name=$_FILES['slika']['tmp_name'];
    $error=$_FILES['slika']['error'];

    if($error===0){
        if($img_size>1250000){
            $em = "File to large!";
            header("Location:../dodajVest.php?error=largePic");
        }
        else{
            $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg","jpeg","png","webp");
            if(in_array($img_ex_lc,$allowed_exs)){
                $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path = '../slike/'.$new_img_name;
                move_uploaded_file($tmp_name,$img_upload_path);
                createVest($conn,$naslov,$tekst,$new_img_name,$ime,$idK);
            }
            else{
                //$em="You cant upload files of this type!";
                header("Location:../dodajVest.php?error=pogresanFajl");   
            }
        }
    }
    else{
        header("location:../DodajVest.php?error=praznaSlika");
        exit();  
    }
    
?>