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
    .korisnici{
        display: flex;
        justify-content: space-around;
        margin-bottom: 10px; 
    }
    table{
        margin-top: 20px;
        border-collapse: collapse;
        width: 70%;
    }
    table th{
        background-color: #fb3958;
        color: white;
    }
    td, th{
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #C3E0E5;
    }
    .netacno{
        color: red;
        font-size: 22px;
        margin-left: 25%;
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

        
        echo "<div class='korisnici'>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Ime i prezime</th>";
                    echo "<th>JMBG</th>";
                    echo "<th>Email</th>";
                    echo "<th>Datum rodjenja</th>";
                    echo "<th>Username</th>";
                    echo "<th>Vrsta</th>";
                    echo "<th>Pol</th>";
                    echo "<th>Izbriši</th>";
                echo "</tr>";

                $serverName="localhost";
                $dbUsername="Muhamed";
                $dbPassword="projekatphp";
                $dbName="ProjekatPhp";
                
                $conn = new mysqli($serverName,$dbUsername,$dbPassword,$dbName);
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
                $sql = "SELECT Id,Ime,Prezime,Pol,Datum_rodjenja,Jmbg,Email,Username FROM adminn";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>".$row["Ime"]." ".$row["Prezime"]."</td>";
                            echo "<td>".$row["Jmbg"]."</td>";
                            echo "<td>".$row["Email"]."</td>";
                            echo "<td>".$row["Datum_rodjenja"]."</td>";
                            echo "<td>".$row["Username"]."</td>";
                            echo "<td>Admin</td>";
                            echo "<td>".$row["Pol"]."</td>";
                            echo "<td></td>";
                        echo "</tr>";  
                    }
                }
                $sql = "SELECT Id,Ime,Prezime,Pol,Datum_rodjenja,Jmbg,Email,Username FROM doktor";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>".$row["Ime"]." ".$row["Prezime"]."</td>";
                            echo "<td>".$row["Jmbg"]."</td>";
                            echo "<td>".$row["Email"]."</td>";
                            echo "<td>".$row["Datum_rodjenja"]."</td>";
                            echo "<td>".$row["Username"]."</td>";
                            echo "<td>Doktor</td>";
                            echo "<td>".$row["Pol"]."</td>";
                            echo "<td><a onclick='return checkDelete()' href='includes/obrisiDoktora.inc.php?Id=".$row["Id"]."'><i class='fa-solid fa-circle-xmark netacno'></i></a></td>";
                        echo "</tr>";  
                    }
                }
                $sql = "SELECT Id,Ime,Prezime,Pol,Datum_rodjenja,Jmbg,Email,Username FROM pacijent";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>".$row["Ime"]." ".$row["Prezime"]."</td>";
                            echo "<td>".$row["Jmbg"]."</td>";
                            echo "<td>".$row["Email"]."</td>";
                            echo "<td>".$row["Datum_rodjenja"]."</td>";
                            echo "<td>".$row["Username"]."</td>";
                            echo "<td>Pacijent</td>";
                            echo "<td>".$row["Pol"]."</td>";
                            echo "<td><a onclick='return checkDelete2()' href='includes/obrisiPacijenta.inc.php?Id=".$row["Id"]."'><i class='fa-solid fa-circle-xmark netacno'></i></a></td>";
                        echo "</tr>";  
                    }
                }
            echo "</table>";
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
            var cf = confirm("Da li ste sigurni da želite da obrišete doktora?");
            if(cf){
                return alert("Uspešno ste obrisali doktora.");
            }
        }
        function checkDelete2(){
            var cf = confirm("Da li ste sigurni da želite da obrišete pacijenta?");
            if(cf){
                return alert("Uspešno ste obrisali pacijenta.");
            }

        }
    </script>
    
        
        
</body>
</html>