<?php
    session_start();
    require_once './includes/functions.inc.php';
    require_once './includes/dbh.inc.php';
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
    .image{
        background: url(slike/pocetna1.jpg);
        width: 100%;
        height: 500px;
        background-size: cover;
        background-repeat: no-repeat;
        position: relative;
    }
    .content{
        position: absolute;
        top: 30%;
        left: 50%;
        width: 50%;
        transform: translate(-80%);
    }
    .content h1{
        color: white;
    }
    .content p{
        color: white;
        font-size: 17px;
    }
    button{
        padding: 10px 20px;
        background-color: #7EC8E3;
        border: none;
        border-radius: 5px;
    }
    button:hover{
        background-color: #189AB4;
        color: white;
        transition: 0.5s;
    }
    a button{
        text-decoration: none;
        color: black;
        cursor: pointer;
    }
    .oNama{
        width: 90%;
        margin: 15px 5%;  
    }
    .slikatext{
        display: flex;
        justify-content: space-around;
    }
    .glavnaGalerija{
        width: 100%;
        height: 700px; 
        background-color: #189AB4;
    }
    .galerija{
        width: 100%;
        height: 600px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .galerija-slider{
        background-color: green;
        width: 850px;
        height: 500px;
        overflow: hidden;
        border-radius: 10px;
        position: relative;
    }
    .image-container{
        display: flex; 
        transition: transform 0.4s ease-in-out;
    }
    .btn{
        position: absolute;
        font-size: 30px;
        cursor: pointer;
    }
    .levo{
        left: 17.5%;
    }
    .desno{
        right: 17.5%;
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
        height: 400px;
        border: 2px solid black;
        margin: 0px 0px 2.5% 3.5%;
        -webkit-box-shadow: 7px 11px 25px -10px;
        -moz-box-shadow: 7px 11px 25px -10px;
        box-shadow: 7px 11px 25px -10px;
    }
    .doktor:hover{
        background-color: #189AB4;
        transition: 0.5s;
        color: white;
    }
    .doktor img{
        width: 100%;
        height: 200px;
    }
    .deskripcija{
        padding: 15px;
        text-align: center;
    }
    .ime{
        font-size: 20px;
        color: #fb3958;
        font-weight: bold;
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
        color: #050A30;
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
    <div class='image'>
        <div class='content'>
            <h1>Dobrodošli na Med ORL</h1>
            <p>Operacija uha, nosa i grla</p>
            <p>Pogledajte naše usluge ili zakažite termin</p>
            <div>
                <a href="usluge.php"><button>Usluge</button></a>
            </div>
        </div>
    </div>
    <div class="oNama">
        <h1 style="text-align:center">Kratko o nama</h1>
        <p>Med ORL je specijalistička ordinacija koja se bavi kompletnom otorinolaringološkom dijagnostikom i lečenjem kako dece tako i odraslih.
            Osnovana je 2001. godine.
            Nasa ordinacija je opremljena najsavremenijim uređajima za dijagnostiku oboljenja u otorinolaringologiji.
            Naša misija je pružanje zdravstvene pomoći sa dostojanstvom i saosećanjem za one kojima služimo. 
            Prihvatili smo na sebe obavezu da obezbedimo najviši nivo kvaliteta usluge, za svakog našeg pacijenta. 
            Posvećeni smo pružanju zdravstvenih usluga sa holističkim pristupom uma, tela i duha.</p>
        <div class="slikatext">
            <div>
                <img src="slike/malisan.jpg" alt="" width="300px" height="170px">
                <p>Pregledi uva kod dece i odraslih</p>
            </div> 
            <div>
            <img src="slike/laringoskopija.webp" alt="" width="300px" height="170px">
                <p>Detaljan pregled grla</p>
            </div>
        </div>
    </div>
    <div class="glavnaGalerija">
        <h1 style="text-align:center;margin-bottom:0px;padding-top: 25px">Galerija</h1>
        <div class="galerija">
            <div class="galerija-slider">
                <div class="image-container">
                    <img src="slike/nos.jpg" alt="" width="850px" height="500px">
                    <img src="slike/ear-nose.jpg" alt="" width="850px" height="500px">
                    <img src="slike/tric.jpg" alt="" width="850px" height="500px">
                </div>
            </div>
            <i class="fa-solid fa-angles-left btn levo"></i>
            <i class="fa-solid fa-angles-right btn desno"></i>
        </div>
    </div>
    <h1 style="text-align:center">Naš tim doktora</h1>

    <?php
        echo "<div class='doktori'>";
            $serverName = "localhost";
            $dbUsername = "Muhamed";
            $dbPassword = "projekatphp";
            $dbName = "ProjekatPhp";
            $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
            if(!$conn){
                die("Connection failed: ".mysqli_connect_error());
            }
            $sql = "SELECT Ime,Prezime,Mesto_rodjenja,Drzava_rodjenja,Datum_rodjenja,Email,Slika FROM doktor ORDER BY Id DESC";
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
    
    <script>
        const sledeceDesno = document.querySelector(".desno");
        const sledeceLevo = document.querySelector(".levo");
        const imageContainer = document.querySelector(".image-container");
        let trenutnaSlika = 1;

        sledeceDesno.addEventListener("click", ()=>{
            trenutnaSlika++;
            updateSlika();
        })

        function updateSlika(){
            if(trenutnaSlika > 3){
                trenutnaSlika = 1;
            }
            else if(trenutnaSlika < 1){
                    trenutnaSlika = 3;
                }
            imageContainer.style.transform = `translateX(-${(trenutnaSlika - 1) * 850}px)`;
        }

        sledeceLevo.addEventListener("click", ()=>{
            trenutnaSlika--;
            updateSlika();
        })        
    </script>
</body>
</html>