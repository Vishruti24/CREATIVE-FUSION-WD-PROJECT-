<?php
 session_start();
                // $_SESSION["Logged_in"] =false;
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
   <div class="navbar">
        <h1>Creative Fusion</h1>
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li>
                <a href="#">Services</a>
                <ul class="dropdown">
                    <li><a href="logo.php">1.Logo Design</a></li>
                    <li><a href="banner.php">2.Banner Design</a></li>
                    <li><a href="advertisement.php">3.Advertisement Design</a></li>
                    <li><a href="visiting.php">4.Visiting Card Design</a></li>
                    <li><a href="artwork.php">5.Artwork Design</a></li>
                    <li><a href="thumbnail.php">6.Thumbnail Design</a></li>
                </ul>
            </li>

            <li><a href="contact_us.php">Contact</a></li>
            <?php 
                if(empty($_SESSION['Logged_in']) || !$_SESSION["Logged_in"] ){
            ?>
            <li><a href="registration.php">Sign Up</a></li>
            <li><a href="login.php  ">Sign In</a></li>
            <?php 
                }else if(!empty($_SESSION['Logged_in']) || $_SESSION["Logged_in"]){
                    ?>
           <li><a href="logout.php">Logout</a></li>
            <?php 
            }
                ?>
        </ul>
    </div>

    <script>
        function toggleMenu() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>