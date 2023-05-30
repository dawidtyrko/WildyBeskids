
<?php
    session_start();
    require_once "connection.php";
    $errorMess="";

     if(isset($_POST['submitRegister'])){
        do{
         $ok = true;
         $firstName = htmlentities($_POST['firstName'], ENT_QUOTES);
         $lastName = htmlentities($_POST['lastName'],ENT_QUOTES);
         $email = filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL);
         $user = htmlentities( $_POST['userName'],ENT_QUOTES);
         $userPass = htmlentities($_POST['userPass'], ENT_QUOTES);
         $passwordRepeat = htmlentities($_POST['repeatPass'], ENT_QUOTES);

        if(ctype_alnum($user)==false){
            $ok = false;
            $errorMess="All characters must be alphanumeric";
            break;
        }
        if(strlen($user)>30){
            $errorMess="Too long username";
            $ok = false;
            break;
        }
        if(strlen($user)<5){
            $errorMess="Too short username";
            $ok = false;
            break;
        }

        if(ctype_alnum($firstName)==false){
            $errorMess="All characters must be alphanumeric";
            $ok = false;
            break;
        }
        if(ctype_alnum($lastName)==false){
            $errorMess="All characters must be alphanumeric";
            $ok = false;
            break;
        }
        $emailSearch = "SELECT idUser FROM users WHERE email = :email";
        $search = $conn->prepare($emailSearch);
        $search->execute([
            'email' => $email
        ]);
        if(($search->rowCount())>0){
            $errorMess="Email already exists";
            $ok = false;
            break;
        }
        

        if($userPass != $passwordRepeat){
            $errorMess="Passwords are not equal";
            $ok = false;
            break;
            
        }
        if(strlen($userPass)>30 || strlen($userPass)<5){
            $errorMess="Password length must be > 5 and < 30";
            break;
            $ok = false;
        }
        $hashedPassword = password_hash($userPass,PASSWORD_DEFAULT);
        $sqlSearch = "SELECT idUser FROM users WHERE user = :user";
            $userSearch = $conn->prepare($sqlSearch);
            $userSearch->execute(['user' => $user]);
            
            if(($userSearch->rowCount())>0){
                $errorMess = "User already exists";
                $ok = false;
                break;
            }
        if($ok){
            require_once "connection.php";
            
            $sqlQuery = "INSERT INTO users (user,pass,firstName,lastName,email) 
            VALUES(:user, :pass, :name, :lastName, :email)";
            $result = $conn->prepare($sqlQuery);
            $result->execute(['user' => $user,
                'pass' => $hashedPassword,
                'name' => $firstName,
                'lastName' => $lastName,
                'email' => $email]);

            header('Location: welcomePage.php');    
        }
       
     }while(false);
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    <link rel="icon" type="image/x-icon" href="../WebIcon/icons8-snow-capped-mountain-emoji-32.png">
    <title>WildyBeskids</title>
</head>
<body>
<p id="failure"><?php echo $errorMess?></p>
<div id="registrationContainer">
        <h2>Register</h2>
        <form  method="post">
            <input type="text" placeholder="Name" name="firstName" class="inputLogin" required><br>
            <input type="text" placeholder="Last name" name="lastName" class="inputLogin" required><br>
            <input type="email" name="email" class="inputLogin" placeholder="Email" required><br>
            <input type="text" name="userName" placeholder="User" class="inputLogin" required><br>
            <input type="password" name="userPass" placeholder="Password" class="inputLogin" required><br>
            <input type="password" name="repeatPass" placeholder="Repeat password" class="inputLogin" required><br>
            <input type="submit" name="submitRegister" value="Register" id="submit">
            
        </form>
        <button id="back">Go Back</button>
        <script>
            var back = document.getElementById("back");
            back.addEventListener("click", function(){
                location.replace("welcomePage.php");
            })
        </script>
    </div>
</body>
</html>
