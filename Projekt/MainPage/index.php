<?php
    session_start();
    if(!isset($_SESSION['loggedUser'])){
        header('Location: ../loginPage/welcomePage.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../WebIcon/icons8-snow-capped-mountain-emoji-32.png">
    <link rel="stylesheet" href="main.css">
    <title>WildyBeskids</title>
</head>
<body>
    <nav id="navbar">
        
        <a href="#home" class="active">Home</a>
        <a href="#about">About us</a>
        <a href="../wildForumPage/forum.php">Wild Camping</a>
        <a href="../MountainHutPage/huts.php">Mountain Huts</a>
        <a href="myPlaces.php">My places</a>
        <a href="../MyAccount/account.php">My account</a>
        <?php if(($_SESSION['admin'])==1) echo "<a href='../MyAccount/admin.php'>Admin</a> ";?>
        <a href="./logout.php">Sign out</a>
    </nav>
    <br><br>
    <section id="home">

        <h1 id="title" style="color:#FEFAFB;font-size:50px;">Find peace in nature</h1>
        <table id="nearMountain">
            <tr>
                <td>
                    <span>
                        <img src="../TableImages/kozia.jpeg" alt="">
                    </span>
                        <div>
                        <h2><a href="https://mapa-turystyczna.pl/coords/49.7680009,19.0390393">Kozia</a> </h2>
                        </div>
                </td>
                <td>
                    <span>
                        <img src="../TableImages/Pilsko.jpg" alt="">
                    </span>
                        <div>
                        <h2><a href="https://mapa-turystyczna.pl/node/pilsko">Pilsko</a> </h2>
                        </div>
                </td>
                <td>
                <span>
                    <img src="../TableImages/barania.jpeg" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/node/barania-gora">Barania Góra</a> </h2>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <span>
                    <img src="../TableImages/rysianka.webp" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/node/schronisko-pttk-na-rysiance">Rysianka</a> </h2>
                    </div>
                </td>
                <td>
                <span>
                    <img src="../TableImages/krawcow.jpeg" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/node/bacowka-pttk-krawcow-wierch">Krawców Wierch</a> </h2>
                    </div>
                    
                </td>
                <td>
                <span>
                    <img src="../TableImages/klimczok.jpeg" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/node/schronisko-pttk-klimczok">Klimczok</a> </h2>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <span>
                    <img src="../TableImages/trzyKopce.jpg" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/node/trzy-kopce-pod-klimczokiem">Trzy kopce</a> </h2>
                    </div>
                </td>
                <td>
                <span>
                    <img src="../TableImages/bacowka.jpeg" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/coords/49.6205728,19.0191106">Bacówka na Baraniej</a> </h2>
                    </div>
                </td>
                <td>
                <span>
                    <img src="../TableImages/blatnia.jpeg" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/node/schronisko-pttk-na-blatniej">Błatnia</a> </h2>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <span>
                    <img src="../TableImages/magurka.jpeg" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/node/schronisko-pttk-na-magurce">Magurka</a> </h2>
                    </div>
                </td>
                <td>
                <span>
                    <img src="../TableImages/babia.jpeg" alt="">
                </span>
                    <div>
                    <h2><a href="https://mapa-turystyczna.pl/node/babia-gora-diablak">Babia Góra</a> </h2>
                    </div>
                    
                </td>
                <td>
                <span>
                    <img src="../TableImages/skrzyczne.webp" alt="">
                </span>
                    <div>
                        <h2><a href="https://mapa-turystyczna.pl/node/schronisko-pttk-skrzyczne">Skrzyczne</a> </h2>
                    </div>
                    
                </td>
            </tr>
            
        </table>
    </section>
    
    <section id="about">
        <div id="aboutHeader">
            <h1>Something about us</h1>
        </div>
        <p>This website was created for people with passion for adventures and wild camping.
            <br>There's a lot to explore out there and it is always great to share it with people of common passion.
            <br>Beskidy are the main topic of this page, but Poland hides many more beautiful places.
            <br>Beskidy is a beautiful mountain range located in the southern part of Poland, extending from the border 
            with Slovakia to the border with the Czech Republic. 
            <br>It is one of the most popular tourist destinations in the country, known for its breathtaking landscapes,
             picturesque villages, and rich cultural heritage.
            <br>The Beskidy range is home to several peaks, with the highest being Babia Góra, which reaches a height of 1,725 meters.
            <br>The mountains are covered in dense forests and dotted with numerous streams, waterfalls, and lakes.
            <br>The scenery is truly stunning, especially during the autumn months when the foliage turns into an array of fiery colors.
            <br>The Beskidy region is also famous for its rich cultural heritage, with numerous traditional wooden architecture buildings and
              historical monuments scattered throughout the area. 
            <br>The people of Beskidy are proud of their traditions, which are rooted in a mix of Polish, Slovak, and Lemko cultures.
            <br>There are plenty of outdoor activities to enjoy in the Beskidy region, including hiking, cycling, skiing, and snowboarding.
            <br>The area is also known for its excellent cuisine, with a range of traditional dishes that reflect the
             region's agricultural and culinary heritage.
            <br> Overall, Beskidy is a unique and fascinating destination that offers visitors an unforgettable experience, whether they are 
            looking to relax in the scenic countryside or engage in outdoor adventures.
            <br>It is definitely worth a visit for anyone interested in exploring the natural and cultural treasures of Poland.
        </p>

    </section>
<p id="about"></p>
<script src="script.js"></script>
<footer>
    <p>&copy; Copyright 2023 Dawid tyrko</p>
</footer>

</body>
</html>