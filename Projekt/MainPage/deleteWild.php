<?php
session_start();
require_once "../loginPage/connection.php";
if(!isset($_SESSION['loggedUser'])){
        header('Location: ../loginPage/welcomePage.php');
}
else{
    $userId = $_SESSION['loggedId'];
}

$deleteQuery = "DELETE FROM post WHERE idPost = :id";
$result = $conn->prepare($deleteQuery);
$idPost = $_GET['idWild'];
// echo $idPost;
$result->execute([
    'id' =>$idPost
]);

header('Location: index.php');
exit;
?>