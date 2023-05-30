<?php
session_start();
require_once "../loginPage/connection.php";
if(!isset($_SESSION['loggedUser'])){
        header('Location: ../loginPage/welcomePage.php');
}
else{
    $userId = $_SESSION['loggedId'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../WebIcon/icons8-snow-capped-mountain-emoji-32.png">
    <link rel="stylesheet" href="forum.css">
    <title>WildyBeskids</title>
    <style>
        body{
            overflow-x:hidden;
            padding:0px;
        }
        .postContainer{
            width: 600px;
            height: 700px;
            
            background-color: #818F77;
            margin-left: auto;
            margin-right: auto;
            
            position: relative;
            letter-spacing: 1px;
            border-radius:10px;
            margin-bottom:10px;
           
        }
        .user{
           margin-left:5px;
            float:left;
            font-size:26px;
            color:#FEFAFB;
        }
        .starsWater{
            position: absolute;
            right:8%;
            font-size:26px;
            color:#FEFAFB;
        }
        .postLink{
            position: absolute;
            top:35px;
            left:5px;
            font-size:20px;
            
        }
        .tableImg{
            
            position: absolute;
            top: 30%;
        }
        
        .date{
            position: absolute;
            left:5px;
            color:#FEFAFB;
            bottom:0;
            font-size:17px;
        }
        .postLink a{
            text-decoration:none;
            color:#FEFAFB;
            transition: all 0.2s ease-in-out;
        }
        .postLink a:hover{
            cursor: pointer;
            color: rgb(20, 208, 145);
        }
        .imageClass{
            
           max-width:600px;
            max-height:400px;
            width:auto;
            height:auto;
        }
        .descriptionPost{
            color:#FEFAFB;
        }
        .sticky{
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 99;
         }
        .sticky + .content{
        padding-top: 60px;
        }
       
    </style>
</head>
<body>
    <nav id="navbar">
        <a href="../MainPage/index.php" >Home</a>
        <a href="#createPostDiv" class="active">Wild Camping</a>
        <a href="../MountainHutPage/huts.php">Mountain Huts</a>
        <a href="../MainPage/myPLaces.php">My places</a>
        <a href="../MyAccount/account.php">My account</a>
        <?php if(($_SESSION['admin'])==1) echo "<a href='../MyAccount/admin.php'>Admin</a> ";?>
        <a href="../MainPage/logout.php">Sign out</a>
    </nav>
   <br><br><br>
   <button id="createPostDiv">
   <a style="width:180px;" href="create.php" id="createLink">+ Create a new post
   </button>
   

<br><br><br><br>
<?php

    $forumQuery = "SELECT post.idPost as postId, latitude,longitude,stars,water,users.user as userName,
    description,image.filename as image, dateAdded FROM post
    JOIN image ON image.idImage = post.idImage
    JOIN users ON users.idUser = post.idUser";
    $forumResult = $conn->prepare($forumQuery);
    $forumResult->execute();
    $data = $forumResult->fetchAll();
    $counter = 0;
    foreach($data as $d){
        
        $stars = $d['stars'];
        $water = $d['water'];
        $coords = $d['latitude'].','.$d['longitude'];
        $image = $d['image'];
        $description = $d['description'];
        $dateAdd = $d['dateAdded'];
        $user = $d['userName'];
        $postId = $d['postId'];

        echo "<div class='postContainer'>";
        echo "<div class='user'>";
        echo $user;
        echo "</div>";

        echo "<div class='starsWater'>";
        if($stars==1)echo ' Stars'.'&#10003;'.' ';else echo ' Stars'.'&#10006;'.' ';
        if($water==1)echo ' Water'.'&#10003;'.' ';else echo ' Water'.'&#10006;'.' ';
        echo "</div>";

        echo "<div class='postLink'>";    
        echo "<a href='https://mapa-turystyczna.pl/coords/$coords'>Check this place on map</a>";
        echo "</div>";

        echo "<br><br><br><br>"; 

        echo "<div >";
        echo "<img src='Images/$image' alt='' class='imageClass' >";
        echo "</div>";

        echo "<div class='descriptionPost'>";
        echo $description."<br>";
        echo "</div>";  
        
        echo "<div class='date'>";
        echo $dateAdd;    
        echo "</div>";  

        if(($_SESSION['admin'])==1) echo "<a class='deleteBtn' href='../MainPage/deleteWild.php?idWild=$postId'>Delete</a>";
        echo "</div>";  
        $counter++;
    }
?>
   
        
           


</div>
<script src="../MainPage/script.js"></script>
    
<footer style="width:100%;position:relative;">
    <p>&copy; Copyright 2023 Dawid Tyrko</p>
</footer>
</body>
</html>