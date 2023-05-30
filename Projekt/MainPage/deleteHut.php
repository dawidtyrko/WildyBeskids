<?php
session_start();
require_once "../loginPage/connection.php";
if(!isset($_SESSION['loggedUser'])){
        header('Location: ../loginPage/welcomePage.php');
}
else{
    $userId = $_SESSION['loggedId'];
}

$deleteQuery = "DELETE FROM hutpost WHERE idPost = :id";
$result = $conn->prepare($deleteQuery);
$idPost = $_GET['idHut'];
$result->execute([
    'id' =>$idPost
]);

header('Location: index.php');
exit;
?>