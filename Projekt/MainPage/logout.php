<?php
session_start();
unset($_SESSION['loggedUser']);
unset($_SESSION['loggedId']);
unset($_SESSION['admin']);
header('Location: ../loginPage/welcomePage.php');
?>