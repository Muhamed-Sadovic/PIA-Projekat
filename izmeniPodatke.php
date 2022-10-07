<?php
    session_start();
    require_once './includes/functions.inc.php';
    require_once './includes/dbh.inc.php';
    if(!$_SESSION['id']){
        header("location:index.php");
        exit();
    }
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
    .promenaPodataka{
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        margin-top: 10px;
    }
    label{
        font-size: 20px;
        margin-top: 6px;
    }
    input[type=text],[type=password]{
        width: 30%;
        padding: 10px;
        margin-top: 6px;
    }
    input[type=submit]{
        width: 26%;
        padding: 10px;
        margin-top: 6px;
        background-color: #7EC8E3;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    input[type=submit]:hover{
        background-color: #189AB4;
        color: white;
        transition: 0.5s;
    }
    a{
        text-decoration: none;
        color: #274472;
    }
    a:hover{
        color: red;
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

    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "prazanInput"){
                echo'<script>alert("Popunite sva polja")</script>';
            }
            if($_GET["error"] == "nevazeciEmail"){
                echo'<script>alert("Email nije u ispravnom formatu")</script>';
            }
            if($_GET["error"] == "nevazeciUsername"){
                echo'<script>alert("Username treba da počinje sa velikim slovom i da se sastoji od slova i brojeva")</script>';
            }
            if($_GET["error"] == "usernamePostoji"){
                echo'<script>alert("Ovaj username već postoji")</script>';
            }
            if($_GET["error"] == "lozinkaX"){
                echo'<script>alert("Šifre se ne poklapaju")</script>';
            }
            if($_GET["error"] == "nevazecaDuzina"){
                echo'<script>alert("Šifra mora imati izmedju 8 i 20 karaktera")</script>';
            }
        }
        if(isset($_GET["success"])){
            if($_GET["success"] == "uspesnoPronenjeniPodaci"){
                echo'<script>alert("Uspešno ste promenili podatke.")</script>';
            }
        }
    ?>

    <form class="promenaPodataka" action="includes/izmeniPodatke.inc.php" method="POST" enctype="multipart/form-data">
        <h1>Promeni podatke</h1>
        <label for="">Email</label>
        <input type="text" name="email" placeholder="Vaš novi email...">
        <label for="">Username</label>
        <input type="text" name="username" placeholder="Vaše novo korisnicko ime...">
        <label for="">Lozinka</label>
        <input type="password" name="lozinka" id="" placeholder="Vaša nova lozinka...">
        <label for="">Potvrdi lozinku</label>
        <input type="password" name="potvrda_lozinke" id="" placeholder="Potvrda lozinke..."><br>        
        <input type="submit" name="submit" value="Promeni"><br>
    </form>

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