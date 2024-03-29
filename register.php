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
    .register{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        flex-direction: column;
    }
    form{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        flex-direction: column;
    }
    label{
        font-size: 20px;
        margin-top: 6px;
    }
    input[type=text],[type=password],[type=date],[type=email],[type=number],[type=submit]{
        width: 30%;
        padding: 10px;
        margin-top: 6px;
        margin-bottom: 5px;
    }
    select{
        width: 32%;
        padding: 10px;
        margin-top: 6px;
        margin-bottom: 5px;
    }
    input[type=submit]{
        background-color: #7EC8E3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
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
    <?php
        if(isset($_GET["error"])){
            if($_GET["error"]=="prazanInput"){
                echo'<script>alert("Popunite sva polja")</script>';
            }
            else if($_GET["error"]=="nevazeceIme"){
                echo'<script>alert("Ime mora poceti velikim slovom")</script>';
            }
            else if($_GET["error"]=="nevazecePrezime"){
                echo'<script>alert("Prezime mora poceti velikim slovom")</script>';
            }
            else if($_GET["error"]=="nevazeceMesto"){
                echo'<script>alert("Grad mora poceti velikim slovom")</script>';
            }
            else if($_GET["error"]=="nevazecaDrzava"){
                echo'<script>alert("Drzava mora poceti velikim slovom")</script>';
            }
            else if($_GET["error"]=="nevazeciDatum"){
                echo'<script>alert("Morate imati iznad 18 godina")</script>';
            }
            else if($_GET["error"]=="nevazeciJMBG"){
                echo'<script>alert("JMBG mora imati tacno 13 cifara")</script>';
            }
            else if($_GET["error"]=="nevazeciTelefon"){
                echo'<script>alert("Telefon mora imati 6-10 brojeva")</script>';
            }
            else if($_GET["error"]=="nevazeciEmail"){
                echo'<script>alert("Email nije u ispravnom formatu")</script>';
            }
            else if($_GET["error"]=="lozinkaX"){
                echo'<script>alert("Šifre se ne poklapaju")</script>';
            }
            else if($_GET["error"]=="nevazecaDuzina"){
                echo'<script>alert("Sifra mora imati izmedju 8 i 20 karaktera")</script>';
            }
            else if($_GET["error"]=="jmbgPostoji"){
                echo'<script>alert("Ovaj korisnik vec postoji")</script>';
            } 
            else if($_GET["error"]=="stmtfailed"){
                echo'<script>alert("Greska")</script>';
            }
        } 
    ?>
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
    <div class="register">
        <h1>Registruj se</h1>
        <form method="POST" id="formm" action="includes/signup.inc.php" enctype="multipart/form-data"> 
            <label for="">Ime</label>
            <input type="text" id="ime" name="ime" placeholder="Vaše ime">

            <label for="">Prezime</label>
            <input type="text" id="prezime" name="prezime" placeholder="Vaše prezime">

            <label for="">Pol</label>
            <select name="pol" id="pol">
                <option value=""></option>
                <option value="M">Muški</option>
                <option value="Z">Ženski</option>
            </select>

            <label for="">Mesto rodjenja</label>
            <input type="text" id="mesto" name="mesto" placeholder="Mesto rodjenja">

            <label for="">Država rodjenja</label>
            <input type="text" id="drzava" name="drzava" placeholder="Država rodjenja">

            <label for="">Datum rodjenja</label>
            <input type="date" id="datum" name="datum" placeholder="Datum">

            <label for="">JMBG</label>
            <input type="text" id="jmbg" name="jmbg" placeholder="Vaš JMBG">
            
            <label for="">Kontakt telefon</label>
            <input type="text" id="telefon" name="telefon" placeholder="Vaš telefon">

            <label for="">E-mail</label>
            <input type="text" id="email" name="email" placeholder="Vaš email">

            <label for="">Slika</label><br>
            <input type="file" id="slika" name="slika" placeholder="Vaša slika" onchange="getImage(this.value);">
            <div style="margin-bottom:1rem;" id="display-image"></div>

            <label for="">Lozinka</label>
            <input type="password" id="lozinka" name="lozinka" placeholder="Vaša lozinka">

            <label for="">Potvrdi Lozinku</label>
            <input type="password" id="potvrda_lozinke" name="potvrda_lozinke" placeholder="Potvrdi lozinku">

            <label for="">Zahtev za registraciju kao doktor</label>
            <input type="checkbox" name="doktor" id="doktor"><br>

            <input type="submit" name="submit" value="Registruj se" style="margin-bottom:20px">
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

    <script>
        function getImage(imagename){
            var newimg = imagename.replace(/^.*\\/,"");
            $('#display-image').html(newimg);
        }
    </script>     
</body>
</html>