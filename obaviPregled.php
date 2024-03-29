<?php
    session_start();
    require_once './includes/functions.inc.php';
    require_once './includes/dbh.inc.php';

    $id = $_SESSION["id"];
    $idPac = $_GET["IdPac"];
    $datum = $_GET["Datum"];
    $vreme = $_GET["Vreme"];
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
        font-size: 18px;
        padding: 3%;
    }
    .podaci p{
        margin: 10px 0 10px 0;
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
    .mogucnosti p{
        margin: 2px 0 2px 0;
    }
    .podcontainer{
        display: flex;
        background-color: #189AB4;
        width: 65%;
        border-radius: 20px;
        margin-left: 4%;
    }
    form{
        display: flex;
        align-items: center;
        flex-direction: column;
        width: 100%;
        margin-top: 5%;
    }
    label{
        font-size: 25px;
        margin-top: 10px;
        margin-bottom: 5px;
    }
    textarea{
        width: 65%;
        resize: vertical;
        margin-top: 6px;
        margin-bottom: 5px;
        min-height: 120px;
        max-height: 170px;
        border-radius: 10px;
        border: 2px solid #05445E;
    }
    input[type=submit]{
        width: 30%;
        height: 40px;
        background-color: #05445E;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20px;
    }
    input[type=submit]:hover{
        background-color: #fb3958;
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
            if($_GET["error"] == "prazanInput"){
                echo"<script>alert('Popunite sva polja')</script>";
            }
            else if($_GET["error"] == "nevazecaDijagnoza"){
                echo"<script>alert('Dijagnoza mora imati od 50 do 300 karaktera!')</script>";
            }
            else if($_GET["error"] == "nezaveceLecenje"){
                echo"<script>alert('Lecenje mora imati od 50 do 300 karaktera!')</script>";
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

    <div class='container'>
        <?php
            echo "<div class='profilStrana'>";
                $sql = "SELECT IdPacijenta,JmbgPacijenta,EmailPacijenta,PolPacijenta FROM izabranidoktor WHERE IdPacijenta = $idPac";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $sql2 = "SELECT Ime,Prezime,Slika FROM pacijent WHERE Id = '$row[IdPacijenta]'";
                        $result2 = $conn->query($sql2);
                        if($result2->num_rows > 0){
                            while($row2 = $result2->fetch_assoc()){
                                if($row2["Slika"] != ''){
                                    echo "<img src='slike/".$row2["Slika"]."'>";
                                }
                                else{
                                    echo "<img src='slike/profil.png'>";
                                }
                                echo "<p style='margin-top:10px;margin-bottom:10px'>".$row2["Ime"]." ".$row2["Prezime"]."</p>";
                            }
                        } 
                        echo "<p style='margin-top:0px'>Pacijent</p>";
                        echo "<div class='podaci'>";
                            echo "<p>Jmbg: ".$row["JmbgPacijenta"]. "</p>";
                            echo "<p>Email: ".$row["EmailPacijenta"]. "</p>";
                            echo "<p>Pol: ".$row["PolPacijenta"]."</p>";
                        echo "</div>";
                        echo "<div class='mogucnosti'>";
                            echo "<p>Datum pregleda: $datum</p>";
                            echo "<p>Vreme pregleda: $vreme</p>";
                        echo "</div>";
                    }
                }
            echo "</div>";
        ?>

        <div class="podcontainer">
            <form action="includes/pregledan.php?IdPac=<?php echo"".$idPac?>&Datum=<?php echo"".$datum?>&Vreme=<?php echo"".$vreme?>" enctype="multipart/form-data" method="POST">
                <label for="">Dijagnoza</label>
                <textarea rows="4" cols="50" name="dijagnoza" placeholder="Unesite tekst ovde..."></textarea>
                <label for="">Lečenje</label>
                <textarea rows="4" cols="50" name="lecenje" placeholder="Unesite tekst ovde..."></textarea><br>
                <input type="submit" name="submit" value="Zapiši">
            </form>
        </div>
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