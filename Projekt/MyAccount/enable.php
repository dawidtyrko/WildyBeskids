<?php
session_start();
require_once "../loginPage/connection.php";
if(!($_SESSION['admin'])==1){
    header('Location: ../MainPage/index.php');
    exit;
}
if(!isset($_SESSION['loggedUser'])){
        header('Location: ../loginPage/welcomePage.php');
        exit;
}
else{
    $userId = $_SESSION['loggedId'];
}

$sqlUpdate= "UPDATE users SET 
active = :active WHERE idUser = :idUser";
$Update = $conn->prepare($sqlUpdate);
$Update->execute([
    'active' => 1,
    'idUser' => $_GET['id']
]);
 
 header('Location: admin.php');
 exit;
?>
