<?php
    session_start();
    require_once './includes/functions.inc.php';
    require_once './includes/dbh.inc.php';
    if(isset($_SESSION["id"])){
        $id = $_SESSION["id"];
    }
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
    .vesti{
        margin: 2.5%;
        width: 95%;
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
    .vest{
        width: 28.5%;
        height: 400px;
        border: 2px solid black;
        margin: 0px 0px 2.5% 3.5%;
        position: relative;
        -webkit-box-shadow: 7px 11px 25px -10px;
        -moz-box-shadow: 7px 11px 25px -10px;
        box-shadow: 7px 11px 25px -10px;
    }
    .vest:hover{
        border: 2px solid blue;
        transition: 0.3s;
    }
    .vest a{
        color: #fb3958;
    }
    .vest a:hover{
        color: #7EC8E3;
        transition: 0.5s;
    }
    .ikona{
        position: absolute;
        right: 4px;
        top: 4px;
        color: red;
        font-size: 20px;
        cursor: pointer;
    }
    .vest img{
        width: 100%;
        height: 200px;
    }
    .deskripcija{
        padding: 15px;
        text-align: center;
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
    .nemaVesti{
        width: 100%;
        height: 100px;
        display: flex;
        justify-content: center;
        font-size: 30px;
        padding-top: 20px;
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
    
    <h1 style='text-align:center'>Vesti</h1>
    <?php
        echo "<div class='vesti'>";
            $serverName="localhost";
            $dbUsername="Muhamed";
            $dbPassword="projekatphp";
            $dbName="ProjekatPhp";
            $conn=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
            if(!$conn){
                die("Connection failed: ".mysqli_connect_error());
            }
            $sql = "SELECT Id,Naslov,Tekst,Slika,KreatorIme,IdKreatora FROM vesti ORDER BY Id DESC";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){                  
                    echo "<div class='vest'>";
                        echo "<img src='slike/".$row['Slika']."'>";
                        echo "<div class='deskripcija'>";
                            if(proveriAdmina($conn,$row["IdKreatora"])){
                                echo "<p>Admin ".$row["KreatorIme"]."</p>";
                            }
                            else{
                                echo "<p>Dr ".$row["KreatorIme"]."</p>";
                            }
                            echo "<p>".substr($row["Tekst"],0,100)."...</p>";
                            echo "<a href='vest.php?Id=".$row["Id"]."'>Pročitaj vise...</a>";
                            if(isset($_SESSION["id"])){
                                if(proveriAdmina($conn,$id)){
                                    echo "<a href='includes/izbrisiVest.php?Id=".$row["Id"]."' onclick='return checkDelete()'><i class='fa-solid fa-circle-xmark ikona'></i></a>";
                                }                      
                            }
                        echo "</div>";
                    echo "</div>";
                }
            }
            else{
                echo "<div class='nemaVesti'>Trenutno ne postoji nijedna vest</div>";
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
        
    <script>
        function checkDelete(){
            var cf = confirm("Da li ste sigurni da želite da obrišete ovu vest?");
            if(cf){
                return alert("Uspešno ste obrisali vest.");
            }
        }
    </script>
</body>
</html>