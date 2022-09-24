<?php
    session_start();
    require_once './includes/functions.inc.php';
    require_once './includes/dbh.inc.php';
    $id = $_SESSION["id"];
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
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
    .container{
        width: 95%;
        margin: 2.5%;
        display: flex;
        justify-content: flex-start;   
    }
    .profilStrana{
        width: 30%;
        height: 500px;
        background-color: #189AB4;
        border-radius: 10px;
        display: flex;
        align-items: center;
        flex-direction: column;
        color: white;
        font-size: 20px;
    }
    .profilStrana img{
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }
    .podaci{
        width: 80%;
        border-radius: 20px;
        background-color: #05445E;
        color: white;
        font-size: 15px;
        padding: 3%;
    }
    button{
        width: 100%;
        padding: 10px;
        margin-top: 6px;
        background-color: #7EC8E3;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover{
        background-color: #5885AF;
        color: white;
        transition: 0.5s;
    }
    .mogucnosti{
        width: 80%;
        display: flex;
        background-color: #05445E;
        border-radius: 20px;
        flex-direction: column;
        margin-top: 4%;
        margin-bottom: 4%;
        padding: 10px;
    }
    .mogucnosti a{
        margin-bottom: 8px;
        color: white;
        padding: 2px 0px 0px 2px;
    }
    .mogucnosti a:hover{
        background-color: #fb3958;
        transition: 0.5s;
    }
    .podcontainer{
        display: flex;
        align-items: center;
        width: 65%;
        flex-direction: column;
        max-height: 621px;
        margin-left: 4%;
    }
    .doktori{
        width: 100%;
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        margin-left: 5%;
    }
    .doktor{
        width: 30%;
        height: 410px;
        border: 2px solid black;
        margin: 0px 0px 2.5% 2%;
        -webkit-box-shadow: 7px 11px 25px -10px;
        -moz-box-shadow: 7px 11px 25px -10px;
        box-shadow: 7px 11px 25px -10px;
    }
    .doktor img{
        width: 100%;
        height: 200px;
    }
    .deskripcija{
        padding: 15px;
        text-align: center;
    }
    .izaberi{
        padding: 3px 15px;
        background-color: #fb3958;
        border-radius: 10px;
    }
    .izaberi:hover{
        background-color: #7EC8E3;
        color: white;
        transition: 0.5s;
    }
    .podcontainerIz{
        display: flex;
        align-items: center;
        width: 65%;
        flex-direction: column;
        max-height: 621px;
        margin-left: 2%;
    }
    .izabraniDoktori{
        width: 95%;
        display: flex;
        justify-content: flex-start;
        margin-left: 5%;
        background-color: #fb3958;
    }
    .slikaIzabranogDoktora{
        width: 30%;
    }
    .slikaIzabranogDoktora img{
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }
    .podaciIzabranogDoktora{
        font-size: 20px;
        margin-left: 3%;
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

        $serverName="localhost";
        $dbUsername="Muhamed";
        $dbPassword="projekatphp";
        $dbName="ProjekatPhp"; 
        $conn=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
        if(!$conn){    
            die("Connection failed: ".mysqli_connect_error());
        }
        $sql = "SELECT IdDoktora,ImeDoktora,ImePacijenta,PrezimePacijenta,EmailPacijenta,PolPacijenta FROM izabranilekar WHERE IdPacijenta = $id;";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $izabran = true;
            while($row = $result->fetch_assoc()) {
                $p = $row['IdDoktora'];       
            }      
        } 
        else{
            $izabran = false;  
        }

        $paci = false;
        if(proveriPacijenta($conn,$id)){
            $paci = true;
            echo "<div class='container'>";
                echo "<div class='profilStrana'>";
                    $serverName="localhost";
                    $dbUsername="Muhamed";
                    $dbPassword="projekatphp";
                    $dbName="ProjekatPhp";
                    $conn=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
                    if(!$conn){
                        die("Connection failed: ".mysqli_connect_error());
                    }
                    $sql = "SELECT Ime,Prezime,Pol,Mesto_rodjenja,Drzava_rodjenja,Datum_rodjenja,Jmbg,Telefon,Email,Slika,Username FROM doktor WHERE Id = $p";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            if($row["Slika"] != ''){
                                echo "<img src='slike/".$row["Slika"]."'>";
                            }
                            else{
                                echo "<img src='slike/profil.png'>";
                            }
                            echo "<p style='margin-top:5px;margin-bottom:5px'>Vaš izabrani doktor</p>";
                            echo "<p style='margin-top:10px;margin-bottom:10px'>".$row["Ime"]." ".$row["Prezime"]."</p>";
                            echo "<div class='podaci'>";
                                echo "<p>Email: ".$row["Email"]. "</p>";
                                echo "<p>Mesto rodjenja: ".$row["Mesto_rodjenja"].",".$row["Drzava_rodjenja"]."</p>";
                                echo "<p>Datum rodjenja: ".$row["Datum_rodjenja"]. "</p>";
                            echo "</div>";
                                echo "<p style='margin: 5% 10% 0px 10%;font-size:15px'>Ukoliko zelite da promenite lekara kliknite 'Posalji' na doktora kojeg zelite da izaberete.</p>";
                        }
                    }
                echo "</div>";
                if($izabran == true){
                    echo "<div class='podcontainer' style='max-height:none'>";
                        echo "<h1 style='margin-bottom:25px;margin-top:5px'>Posaljite zahtev za promenu lekara</h1>";
                        echo "<div class='doktori'>";
                            $sql = "SELECT Id,Ime,Prezime,Mesto_rodjenja,Drzava_rodjenja,Datum_rodjenja,Email,Slika FROM doktor WHERE Id != $p";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    echo "<div class='doktor'>";
                                        if($row["Slika"] != ''){
                                            echo "<img src='slike/".$row["Slika"]."'>";
                                        }
                                        else{
                                            echo "<img src='slike/profil.png'>";
                                        }
                                        echo "<div class='deskripcija'>";
                                            echo "<p class='ime'>Dr ".$row["Ime"]." ".$row["Prezime"]."</p>";
                                            echo "<p>Email: ".$row["Email"]."</p>";
                                            echo "<p>Mesto: ".$row["Mesto_rodjenja"].",".$row["Drzava_rodjenja"]."</p>";
                                            echo "<p>Datum: ".$row["Datum_rodjenja"]."</p>";
                                            echo "<a onclick = 'return checkZahtev()' href='./includes/promeniDoktora.inc.php?id=".$row['Id']."&Ime=".$row['Ime']."&Prezime=".$row['Prezime']." ' class='izaberi'>Posalji</a>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                            } 
                        echo "</div>";
                    echo "</div>";
                }
                else{
                    echo "<div class='podcontainerIz'>";
                        echo "<p>Trenutno nema doktora.</p>";
                    echo "</div>";
                }
            echo "</div>";
        }
    ?>

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
        
    <script>
        function checkZahtev(){           
            return confirm("Da li ste sigurni da zelite da promenite doktora");
        }
    </script>
</body>
</html>