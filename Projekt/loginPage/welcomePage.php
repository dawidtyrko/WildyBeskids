<?php
session_start();
$errormsg="";

require_once "connection.php";

if(!isset($_SESSION['loggedUser'])){

    if(isset($_POST['submitLogin'])){

    do{
        $user = filter_input(INPUT_POST, 'userName');
        $password = filter_input(INPUT_POST, 'userPass');

        $sqlQuery = "SELECT idUser, pass, user, active FROM users WHERE user = :user";
        $result = $conn->prepare($sqlQuery);
        $result->execute([
            'user' => $user
        ]);
        $userData = $result->fetch();
       
        if($userData['active'] == 0){
            $errormsg="Account disactivated";
            
            break;
        }
        if ($userData &&password_verify($password, $userData['pass'])){
            $_SESSION['loggedUser'] = $userData['user'];
            $_SESSION['loggedId'] = $userData['idUser'];

            $sqlAdmin = "SELECT users.idUser FROM users  
            INNER JOIN admin ON users.idUser = admin.idUser
            WHERE users.idUser = :id;";
            $resultAdmin = $conn->prepare($sqlAdmin);
            $resultAdmin->execute([
                'id' => $userData['idUser']
            ]);
            
            if(($resultAdmin->rowCount())>0){
                $_SESSION['admin'] = 1;
            }
            else{
                $_SESSION['admin'] = 0;
            }
            
            header('Location: ../MainPage/index.php');
        }
        else{
            $errormsg="Wrong user or password";
            break;
            
        }
    }while(false);
}
}
else{
    header('Location: ../MainPage/index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="welcome.css">
    <link rel="icon" type="image/x-icon" href="../WebIcon/icons8-snow-capped-mountain-emoji-32.png">
    <title>WildyBeskids</title>
</head>
<body>
<p id="failure"><?php echo $errormsg?></p>
    <div id="signContainer">
        <h2>Welcome,<br> sign in</h2>
        <form  method="post" >
            <input type="text" name="userName" placeholder="user" class="inputLogin"><br>
            <input type="password" name="userPass" placeholder="password" class="inputLogin"><br>
            <input type="submit" name="submitLogin" value="Zaloguj" id="submit">
        </form>
        <h4>If you don't have an account,<br> <a href="registration.php" id="registrationLink"> register</a></h4>
    </div>
</body>
</html>

