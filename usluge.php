<?php
    session_start();
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
    .sveUsluge{
        width: 85%;
        margin: 15px 7.5% 0 7.5%;
        height: 1850px;
    }
    .usluge{
        display: flex;
        margin: 15px;
    }
    .opis{
        margin: 20px;
    }
    .podNaslov{
        text-align: center;
        color: #0000FF;
    }
    .slika{
        margin: 0 0 0 20px;
    }
    .centar{
        text-align: center;
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

    <div class="sveUsluge">
        <h1 style="text-align:center">Naše usluge</h1>
        <div class="usluge">
            <img src="slike/audiometry.jpg" width="350px" height="350px">
            <div>
                <h2 class="podNaslov">Audiometrija</h2>
                <p class="opis">Audiometrija je neinvazivna dijagnostička procedura kojom se ispituje  sluh i utvrđuje postojanje oštećenja sluha, kao i mesto i stepen
                                eventualnog ošetećenja. Radi se u sklopu rutinskog ispitivanja sluha ili  kod ispitanika sa već registrovanim oštećenjem sluha. Može se raditi 
                                i kod dece nakon pete godine života. Ispitivanje je potpuno bezbolno i komforno i traje oko 20 minuta. 
                                Ovaj test ne nosi nikakav rizik, potpuno je bezbolan i komforan.</p>
                <div class="centar">
                    <a href="cenovnik.php"><button>cenovnik</button></a>
                </div>
            </div>
        </div>

        <div class="usluge">
            <div>
                <h2 class="podNaslov">Rinoplastika-Korekcija nosa</h2>
                <p class="opis">Estetska korekcija nosa je jedna od najznačajnijih operacija jer se jasno uočava promena koja znatno doprinosi poboljšanju
                    izgleda i može znatno promeniti fizionomiju. Oblik nosa jedna je od glavnih odličja  ljudskog lica i kao takav doprinosi skladu lica kao celine.
                    Nepravilnost nosa,često određuje i psihicki status osobe, te se nakon urađenog zahvata i oporavka, pacijent oseća mnogo bolje, sigurnije, uspešnije i srećnije.</p>
                <div class="centar">
                    <a href="cenovnik.php"><button>cenovnik</button></a>
                </div>
            </div>
            <img src="slike/kornos.jpg" width="350px" height="350px">
        </div>

        <div class="usluge">
            <img src="slike/laringoskopija.jpg" width="350px" height="350px">
            <div>
                <h2 class="podNaslov">Laringoskopija</h2>
                <p class="opis">Laringoskopija je  metoda kojom se vrši pregled ždrela (zadnjeg dela  grla). Postoji  direktna i indirektna laringoskopija. 
                    U indirektnoj laringoskopiji lekar  koristi malo ogledalo kojim pregleda grlo, bazu  jezika i deo grkljana.  Direktna laringoskopija je endoskopska procedura 
                    koja podrazumeva  korišćenje fleksibilnog optičkog instrumenta u pregledu  ždrela  (grkljana...). Indirektna laringoskopija traje nekoliko minuta. 
                    Direktna laringoskopija traje 30-45 minuta.</p>
                <div class="centar">
                    <a href="cenovnik.php"><button>cenovnik</button></a>
                </div>
            </div>
        </div>

        <div class="usluge">
            <div>
                <h2 class="podNaslov">Timpanometrija</h2>
                <p class="opis">Timpanometrija predstavlja metodu kojom se otkrivaju oboljenja  srednjeg uva koja mogu dovesti do gubitka sluha, naročito kod dece. 
                    Timpanometrija je metoda kojom se ispituje stanje i funkcija srednjeg  uva. Srednje uvo se nalazi iza bubne opne. Bubna opna je tanko tkivo  koje razdvaja 
                    srednje i spoljašnje uvo. Timpanometrija predstavlja  metodu kojom se otkrivaju oboljenja srednjeg uva koja mogu dovesti do  gubitka sluha, naročito kod dece. 
                    Timpanometrijom se procenjuje kretanje  bubne opne koje nastaje nakon promene pritiska u uvu. Može postojati  potreba da se kod dece ovaj pregled radi više 
                    puta svakih nekoliko  nedelja. Na taj način se stiče uvid o stanju srednjeg uva u više  situacija tokom dužeg vremenskog perioda. Kompletno ispitivanje traje
                    oko 5 minuta. Ispitivanje nije praćeno rizikom od komplikacija i potpuno je bezbolno.</p>
                <img src="slike/timpanometrija.jpg" alt="" width="90%" height="300px" class="slika"><br><br>
                <div class="centar">
                    <a href="cenovnik.php"><button>cenovnik</button></a>
                </div>
            </div>

            <div>
                <h2 class="podNaslov">Alergološko testiranje</h2>
                <p class="opis">Alergijski rinitis je hronični upalni proces sluznice nosa nastao kao posledica delovanja alergena. Najčešća je imunološka bolest I u 
                                svetu boluje preko 25% stanovništva. Vrlo često je udružen sa Alergijskom astmom.Najčešći alergeni su inhalacioni. Vrlo je važno na vreme 
                                dijagnostikovati I lečiti alergiju kako bi se sprečile posledice (nastanak polipa u nosu, krvarenja iz nosa, upale ušiju kod dece, 
                                razvoj I pogoršanje astme...).</p>
                <img src="slike/alerg.jpg" alt="" width="400px" height="338px" class="slika"><br><br>
                <div class="centar">
                        <a href="cenovnik.php"><button>cenovnik</button></a>
                </div>
            </div>
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