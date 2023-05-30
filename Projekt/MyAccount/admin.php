<?php
session_start();
require_once "../loginPage/connection.php";
if(!($_SESSION['admin'])==1){
    header('Location: ../MainPage/index.php');
}
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
    <link rel="stylesheet" href="accountStyle.css">
    <title>WildyBeskids</title>
</head>
<body>
    <nav id="navbar">
        <a href="../MainPage/index.php" >Home</a>
        <a href="../wildForumPage/forum.php" >Wild Camping</a>
        <a href="../MountainHutPage/huts.php" >Mountain Huts</a>
        <a href="../MainPage/myPlaces.php" >My places</a>
        <a href="account.php" >My account</a>
        <?php if(($_SESSION['admin'])==1) echo "<a href='' class='active'>Admin</a> ";?>
        <a href="../MainPage/logout.php">Sign out</a>
    </nav>
   <br><br><br><br><br>

    <table id="tableAdmin">
        
        <thead>
            <th>User</th>
            <th>Name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Active</th>
            <th colspan="2">Action</th>
        </thead>
        <tbody>
        <?php
            $infoQuery = "SELECT active,idUser,user,pass,firstName,lastName,email
            FROM users ";
            $resultInfo = $conn->prepare($infoQuery);
            $resultInfo->execute();
            $result = $resultInfo->fetchAll();
            foreach($result as $r){
                echo "
                    <tr>
                        <td>$r[user]</td>
                        <td>$r[firstName]</td>
                        <td>$r[lastName]</td>
                        <td>$r[email]</td>
                        <td>$r[active]</td>
                        <td>
                            <a class='disableBtn' href='disable.php?id=$r[idUser]'>Disable</a>
                        </td>
                        <td>
                            <a class='editBtn' href='enable.php?id=$r[idUser]'>Enable</a>
                        </td>
                    </tr>
                    
                
                ";
            }
        ?>
            
        </tbody>
    </table>


    <script src="../MainPage/script.js"></script>
    
<footer>
    <p>&copy; Copyright 2023 Dawid Tyrko</p>
</footer>
</body>
</html>