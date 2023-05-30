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
    <link rel="stylesheet" href="accountStyle.css">
    <title>WildyBeskids</title>
</head>
<body>
    <?php
     $infoQuery = "SELECT user,firstName,lastName,email
     FROM users WHERE idUser = :id";
     $resultInfo = $conn->prepare($infoQuery);
     $resultInfo->execute([
         'id' =>$userId
     ]);
     $result = $resultInfo->fetchAll();
     foreach($result as $r){
        $name = $r['firstName'];
        $lastName = $r['lastName'];
        $email = $r['email'];
        $user = $r['user'];
     }
     $errorMessage="";
     $successMessage="";

     if(isset($_POST['subChanges'])){
        do{
            if(empty($_POST['name']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['user'])){
                $errorMessage = "All fields are required";
                break;
            }
           
            $sqlUpdate= "UPDATE users SET 
            user = :user, firstName = :firstName, lastName = :lastName,
            email = :email WHERE idUser = :idUser";
            $Update = $conn->prepare($sqlUpdate);
            $Update->execute([
                'user' => filter_input(INPUT_POST, 'user',FILTER_SANITIZE_SPECIAL_CHARS),
                'firstName' => filter_input(INPUT_POST, 'name',FILTER_SANITIZE_SPECIAL_CHARS),
                'lastName' => filter_input(INPUT_POST, 'lastName',FILTER_SANITIZE_SPECIAL_CHARS),
                'email' => filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL),
                'idUser' => $userId
            ]);
             $successMessage="Success";
             
             header('Location: account.php');
             exit;
            
        }while(false);
     }
    
    ?>
    <nav id="navbar">
        <a href="account.php" >Go back</a>
        <a href="" class="active">Edit</a>
    </nav>
   <br><br><br><br><br>
   <p id="error"><?php echo $errorMessage; ?></p>
    <form method="post" id="changeForm">
        <input type="hidden" value="<?php echo $userId; ?>">
        <label for="name">Name</label><br>
        <input type="text" name="name" value="<?php echo $name; ?>"><br>

        <label for="lastName">Last name</label><br>
        <input type="text" name="lastName" value="<?php echo $lastName; ?>"><br>

        <label for="email">Email</label><br>
        <input type="text" name="email" value="<?php echo $email; ?>"><br>

        <label for="user">User</label><br>
        <input type="text" name="user" value="<?php echo $user; ?>"><br>
        
        <input type="submit" name="subChanges" value="Change">
    </form>
    <p id="success"><?php echo $successMessage; ?></p>
</body>
</html>