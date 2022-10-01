<?php
    session_start();
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
    form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    label{
        font-size: 20px;
        margin-top: 6px;
    }
    input[type=text],[type=date]{
        width: 30%;
        padding: 10px;
        margin-top: 6px;
    }
    select{
        width: 31.8%;
        padding: 10px;
        margin-top: 6px;
    }
    input[type=submit]{
        width: 28%;
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
    .doktori{
        margin: 2.5%;
        width: 95%;
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
    .doktor{
        width: 28.5%;
        height: 420px;
        border: 2px solid black;
        margin: 0px 0px 2.5% 3.5%;
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
    .raspored{
        padding: 3px 15px;
        background-color: #fb3958;
        border-radius: 10px;
        margin-bottom: 5px;
    }
    .raspored:hover{
        background-color: #7EC8E3;
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
            if($_GET["error"]=="prazanInput")
            {
                echo'<script>alert("Popunite sva polja")</script>';
            }
        }
?>

    <form action="includes/dodajRaspored.php" method="POST">
        <h1>Dodajte termin</h1>
        <label for="">Doktor</label>
        <select name='doktor'>
            <option></option>
            <?php
                $serverName = "localhost";
                $dbUsername = "Muhamed";
                $dbPassword = "projekatphp";
                $dbName = "ProjekatPhp";
                $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
                if(!$conn){
                    die("Connection failed: ".mysqli_connect_error());
                }
                $sql = "SELECT Id,Ime,Prezime FROM doktor WHERE Cekiraj = 1 ORDER BY Id DESC";
                $result = ($conn->query($sql));
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<option value='$row[Id]'>".$row["Ime"]." ".$row["Prezime"]."</option>";
                    }          
                }
                $conn->close();
            ?>
        </select>
        <label for="">Datum termina</label>
        <input type="date" name="datum" id="">
        <label for="">Vreme termina</label>

        <select name="vreme">
            <option value=""></option>
            <option value="10:00">10:00</option>
            <option value="">11:00</option>
            <option value="">12:00</option>
            <option value="">13:00</option>
            <option value="">14:30</option>
            <option value="">15:30</option>
            <option value="">16:30</option>
            <option value="">17:30</option>
        </select><br>
        <input type="submit" name="submit" value="Dodaj">
        <br><br>
    </form>

    <h1 style="text-align:center">Pogledajte rasporede ostalih doktora</h1>

    <?php
        echo "<div class='doktori'>";
        $serverName="localhost";
        $dbUsername="Muhamed";
        $dbPassword="projekatphp";
        $dbName="ProjekatPhp";
        $conn=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
        if(!$conn){
            die("Connection failed: ".mysqli_connect_error());
        }
        $sql = "SELECT Id,Ime,Prezime,Mesto_rodjenja,Drzava_rodjenja,Datum_rodjenja,Email,Slika FROM doktor WHERE Cekiraj = 1 ORDER BY Id DESC";
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
                        echo "<p>Mesto: ".$row["Mesto_rodjenja"].", ".$row["Drzava_rodjenja"]."</p>";
                        echo "<p>Datum: ".$row["Datum_rodjenja"]."</p>";
                        echo "<a href='rasporedDoktora.php?Id=".$row['Id']."' class='raspored'>Raspored</a>";
                    echo "</div>";
                echo "</div>";
            }
        } 
    echo "</div>";
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
        
        
</body>
</html>