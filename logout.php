<?php
session_start();
// session_unset($_SESSION['Logged_in']);  
session_destroy();
header("Location: ./home.php");
exit();
?>