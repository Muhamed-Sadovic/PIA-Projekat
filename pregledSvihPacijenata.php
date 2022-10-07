<?php
    session_start();
    require_once "includes/functions.inc.php"; 
    require_once "includes/dbh.inc.php";
    $id = $_SESSION["id"];
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
    h1{
        text-align: center;
        margin-bottom: 10px;
        margin-top: 25px;
    }
    .margina{
        margin-bottom: 200px;
    }
    .pregledi{
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        margin-bottom: 10px; 
    }
    .karton{
        margin: auto;
        font-size: 20px;
    }
    .kartonIkonica{
        text-align: center;
    }
    table{
        margin-top: 20px;
        border-collapse: collapse;
        width: 60%;
        margin-bottom: 100px;
    }
    table th{
        background-color:#fb3958;
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
    .boja{
        color: red;
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

    <div class="pregledi">
    <?php
        $sql = "SELECT * FROM pregledi WHERE IdDoktora = $id ORDER BY Datum,Vreme";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "<h1>Zakazani pregledi</h1>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Pacijent</th>";
                    echo "<th>Datum termina</th>";
                    echo "<th>Vreme termina</th>";
                    echo "<th>Obavi pregled</th>";
                    echo "<th>Ukloni termin</th>";
                echo "</tr>";
                echo "<tr>";
                while($row = $result->fetch_assoc()){
                    $sql2 = "SELECT Ime,Prezime FROM pacijent WHERE Id = '$row[IdPacijenta]'";
                    $result2 = $conn->query($sql2);
                    if($result2->num_rows > 0){
                        while($row2 = $result2->fetch_assoc()){
                            echo "<td>".$row2['Ime']." ".$row2["Prezime"]."</td>";
                        }
                    }
                    echo "<td>".$row['Datum']."</td>";
                    echo "<td>".$row['Vreme']."</td>";
                    echo "<td class='kartonIkonica'><a class='karton' href='obaviPregled.php?IdPac=".$row["IdPacijenta"]."&Datum=".$row["Datum"]."&Vreme=".$row["Vreme"]."'><i class='fa-solid fa-file-lines'></i></a></td>";
                    echo "<td class='kartonIkonica'><a class='karton' onclick='return deletePregled()' href='includes/izbrisiPregled.php?IdPac=".$row["IdPacijenta"]."&Datum=".$row["Datum"]."&Vreme=".$row["Vreme"]."'><i class='fa-solid fa-circle-xmark boja'></i></a></td>";
                echo "</tr>";
                }
            echo "</table>";
        }
        else{
            echo "<h1 class='margina'>Trenutno nemate zakazanih pregleda</h1>";
        }
    ?>
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
        function deletePregled(){
            return confirm("Da li želite da uklonite ovaj pregled?");
        }
    </script>
</body>
</html>