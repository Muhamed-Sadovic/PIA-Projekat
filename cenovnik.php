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
    h1{
        text-align: center;
        margin-bottom: 10px;
        margin-top: 25px;
    }
    .cenovnik{
        display: flex;
        justify-content: center;
        margin-bottom: 10px; 
    }
    table{
        margin-top: 20px;
        border-collapse: collapse;
        width: 60%;
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

    <h1>Cenovnik usluga</h1>

    <div class="cenovnik">
        <table>
            <tr>
                <th>Usluga</th>
                <th>Cena</th>
            </tr>
            <tr>
                <td>Specijalistički pregled</td>
                <td>3.000,00</td>
            </tr>
            <tr>
                <td>Kontrola u okviru 10 dana</td>
                <td>2.000,00</td>
            </tr>
            <tr>
                <td>Kontrola u okviru 30 dana</td>
                <td>2.200,00</td>
            </tr>
            <tr>
                <td>Fiberendoskopija</td>
                <td>8.000,00</td>
            </tr>
            <tr>
                <td>Endoskopija uva, nosa i sinusa</td>
                <td>5.000,00</td>
            </tr>
            <tr>
                <td>ORL pregled sa audiometrijom</td>
                <td>4.000,00</td>
            </tr>
            <tr>
                <td>Timpanometrija</td>
                <td>1.200,00</td>
            </tr>
            <tr>
                <td>Audiometrija</td>
                <td>2.000,00</td>
            </tr>
            <tr>
                <td>Ispiranje uva</td>
                <td>2.000,00</td>
            </tr>
            <tr>
                <td>Ultrazvuk štitaste zlezde</td>
                <td>1.800,00</td>
            </tr>
            <tr>
                <td>Ultrazvuk vrata mekih tkiva vrata</td>
                <td>2.200,00</td>
            </tr>
            <tr>
                <td>Dopler krvnih sudova vrata</td>
                <td>2.500,00</td>
            </tr>
            <tr>
                <td>Intratimpanalna instilacija leka</td>
                <td>6.000,00</td>
            </tr>
            <tr>
                <td>ORL tamponada prednja</td>
                <td>2.000,00</td>
            </tr>
            <tr>
                <td>Vađenje stranog tela iz uva (obavezan ORL pregled)</td>
                <td>1.500,00</td>
            </tr>
            <tr>
                <td>Vadjenje stranog tela iz nosa (obavezan ORL pregled)</td>
                <td>1.800,00</td>
            </tr>
            <tr>
                <td>Vadjenje stranog tela iz ždrela (obavezan ORL pregled)</td>
                <td>2.000,00</td>
            </tr>
            <tr>
                <td>Ekstirpacija promene na tonzili/vestibulumu nosa</td>
                <td>16.000,00</td>
            </tr>
            <tr>
                <td>Ekstirpacija promene na bukalnoj sluznic</td>
                <td>18.000,00</td>
            </tr>
            <tr>
                <td>Ekstirpacija promene na jeziku</td>
                <td>20.000,00</td>
            </tr>
            <tr>
                <td>Ekstirpacija dve promene na jeziku</td>
                <td>30.000,00</td>
            </tr>
            <tr>
                <td>Biopsija malih pljuvačnih žlezda</td>
                <td>11.000,00</td>
            </tr>
            <tr>
                <td>Ekstirpacija kalkulusa iz pljuvačne žlezde u lokalnoj anesteziji</td>
                <td>11.000,00</td>
            </tr>
            <tr>
                <td>Brisevi</td>
                <td>700,00</td>
            </tr>
            <tr>
                <td>ORL postavljanje štrajfne sa lekom</td>
                <td>500,00</td>
            </tr>
            <tr>
                <td>ORL pregled sa  alergološkim ispitivanjem /inhalacioni alerg.</td>
                <td>4.000,00</td>
            </tr>
            <tr>
                <td>Kauterizacija nosnog septuma</td>
                <td>13.000,00</td>
            </tr>
            <tr>
                <td>Ekstirpacija ciste na usni</td>
                <td>30.000,00</td>
            </tr>
            <tr>
                <td>Pregled u kućnoj poseti</td>
                <td>5.000,00</td>
            </tr>
            <tr>
                <td>Kontrolni pregled u kućnoj poseti</td>
                <td>3.000,00</td>
            </tr>
        </table>
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