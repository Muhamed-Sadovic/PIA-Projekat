<?php
    session_start();
    if(!$_SESSION['id']){
        header("location:index.php");
        exit();
    }
    require_once './includes/functions.inc.php';
    require_once './includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" 
      integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: arial, sans-serif;
    }
    span{
        color: white;
        font-size: 20px;
    }
    a{
        text-decoration: none;
        color: black;
    }
    header{
        background-color: #75E6DA;
        width: 100%;
        height: 60px;
        display: flex;
        justify-content: space-between;
        padding: 20;
    }
    ul{
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        margin-right: 30px;
    }
    li{
        float: left;
    }
    li a{
        display: block;
        color: white;
        text-align: center;
        padding: 20px 15px 0px 0px;
        text-decoration: none;
    }
    li a:hover{
        color: #274472;
        transition: 1s;
    }
    .novostForma{
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
    .novostForma h1{
        text-align: center;
    }
    form{
        display: flex;
        align-items: center;
        flex-direction: column;
        width: 100%;
    }
    label{
        font-size: 25px;
        margin-top: 10px;
    }
    input[type=text],[type=submit]{
        width: 51%;
        padding: 10px;
        margin-top: 6px;
        margin-bottom: 5px;
    }
    textarea{
        width: 52.5%;
        resize: vertical;
        margin-top: 6px;
        margin-bottom: 5px;
        min-height: 100px;
    }
    input[type=submit]{
        width: 30%;
        background-color: #7EC8E3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20px;
    }
    input[type=submit]:hover{
        background-color: #189AB4;
        color: white;
        transition: 0.5s;
    }
    footer{
        background-color: #75E6DA;
        height: 200px;
        width: 100%;
        display: flex;
        justify-content: space-evenly;
    }
    footer p{
        margin-bottom: 0;
    }
</style>
</head>
<body>
    <?php
        if(isset($_GET["error"])){
            if($_GET["error"]=="prazanInput"){
                echo"<script>alert('Popunite sva polja')</script>";
            }
            else if($_GET["error"]=="nevazeciNaslov"){
                echo"<script>alert('Naslov mora imati od 40 do 100 karaktera!')</script>";
            }
            else if($_GET["error"]=="nevazeciTekst"){
                echo"<script>alert('Tekst mora imati od 300 do 1200 karaktera!')</script>";
            }
            else if($_GET["error"]=="praznaSlika"){
                echo"<script>alert('Dodajte sliku!')</script>";
            }
            else if($_GET["error"]=="pogresanFajl"){
                echo"<script>alert('Pogrešan fajl ste ubacili. Pokušajte ponovo.')</script>";
            }
            else if($_GET["error"]=="uspesnoDodana"){
                echo"<script>alert('Uspešno ste dodali vest.')</script>";
            }
        }
    ?>

    <header>
        <a href="index.php"><p style="margin-left:20px;padding: 2px 15px 0px 0px;"><span>MED</span> ORL</p></a>
        <ul>
            <li><a href="index.php">O nama</a></li>
            <li><a href="usluge.php">Usluge</a></li>
            <li><a href="vesti.php">Blog</a></li>
            <li><a href="cenovnik.php">Cenovnik</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
            <?php
                if(isset($_SESSION["id"])){
                    echo"<li><a href='profil.php'><i class='fas fa-user-alt'></i></a></li>";
                    echo"<li><a href='includes/logout.inc.php'><i class='fas fa-power-off' style='color:red'></i></a></li>";
                }
                else{
                    echo"<li><a href='login.php'>Prijavi se</a></li>";
                }
            ?>
        </ul>
    </header>
    
    <div class="novostForma">
        <h1>Dodajte vest</h1>
        <form action="./includes/dodajVest.inc.php" enctype="multipart/form-data" method="POST">
            <label for="">Naslov</label>
            <input type="text" name="naslov" id="naslov">
            <label for="">Tekst</label>
            <textarea rows="4" cols="50" name="tekst" placeholder="Unesite tekst ovde..."></textarea>
            <label for="">Izaberi sliku</label><br>
            <input type="file" name="slika" id="slika"><br>
            <input type="submit" value="Napravi">
        </form>
    </div>

    <footer>
        <div>
            <h2>Lokacija</h2>              
            <p><i class="fa-solid fa-location-dot" style="color: red;font-size: 20px"></i> Moše pijade 6</p>               
            <p><i class="fa-solid fa-location-dot" style="color: red;font-size: 20px"></i> 36300 Novi Pazar</p>               
            <p>Radno vreme: 07-22h</p>
        </div>
        <div>
            <h2>Kontakt</h2>
            <p><i class="fa-solid fa-phone" style="color: green;font-size: 20px"></i> +381 69 16 15 980</p>
            <p><i class="fa-solid fa-phone" style="color: green;font-size: 20px"></i> +381 63 86 15 980</p>
            <p><a href="mailto: medclinic@gmail.com" style="text-decoration: none;color: black"><i class="fa-solid fa-envelope" style="color: brown;font-size: 20px"></i> medclinic@gmail.com</a></p>
        </div>
        <div>
            <h2>Pratite nas</h2>
            <p><a href="https://www.instagram.com/muhamed.sadovic/"><i class="fa-brands fa-instagram" style="color: #fb3958;font-size: 20px"></i></a> 
            <a href="https://www.facebook.com/profile.php?id=100007525925196"><i class="fa-brands fa-facebook" style="color: blue;font-size: 20px"></i></a> 
            <a href="https://www.youtube.com/channel/UCKOhscLr35pxkNaUN3X6J_A"><i class="fa-brands fa-youtube" style="color: red;font-size: 20px"></i></a></p>
        </div>
    </footer>
        
        
</body>
</html>