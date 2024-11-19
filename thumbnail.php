<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thumbnail Design</title>
	<link rel="stylesheet" type="text/css" href="style.css">
        <style>
            /* Base styles for the body */
        body {
            margin: 0;
            font-family:"Nico Moji";
        }

        /* Navbar styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: black;
            padding: 1px 2px;
            position: sticky;
            top: 0;
            z-index: 1000;
            .dropdown{
                display: none;
            }
        }

        .navbar h1 {
            color: white;
            font-size: 24px;
        }

        /* Navigation links */
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            position: relative;
            margin-left: 20px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            display: flex;
            transition: background-color 0.3s ease;
        }

        .navbar ul li a:hover {
            background-color: #45ffc7;
            border-radius: 5px;
            display: flex;
        }

        /* Dropdown styles */
        .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: black;
            padding: 0;
            min-width: 160px;
            z-index: 999;
            color: white;
        }

        .dropdown li {
            border-bottom: 1px solid white;
            text-align: left;
            display: block;

        }

        .dropdown li a {
            padding: 10px 15px;
            white-space: nowrap;
            display: flex;
        }

        .dropdown li a:hover {
            background-color: #45ffc7;
            display: block;
        }

        /* Show dropdown on hover over the Services */
        .navbar ul li:hover .dropdown {
            display: block;
        }

        /* Styles for mobile menu */
        .navbar .menu-icon {
            display: none;
            font-size: 28px;
            color: white;
            cursor: pointer;
        }

        /* Hide menu for mobile by default */
        .navbar ul {
            display: flex;
            flex-direction: row;
        }

        /* Media query for mobile view */
        @media (max-width: 768px) {
            .navbar ul {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 40px;
                left: 0;
                background-color: black;
                
            }

            .navbar ul li:hover {
                margin: 0;
                border-bottom: 1px solid white;
                text-align: center;
                
            }

            .navbar ul li:hover .dropdown li{
                position: static;
                                display: flex;
                                

            }

            .navbar .menu-icon {
                display: block;
            }

            .navbar.active ul {
                display: flex;
            }
             .dropdown li{
                 margin: 1px;
                 padding: 0px 5px;
                white-space: nowrap;
                display: none;
            }
        }
        
        
        </style>
</head>
<body>
   <div class="navbar">
        <h1>Creative Fusion</h1>
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
        <ul>
            <li><a href="home.php">Home</a></li>
            

            <!-- Dropdown Menu for Services -->
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

            <li><a href="#">Contact</a></li>
            <li><a href="registration.php">Logout</a></li>
        </ul>
    </div>

    <script>
        function toggleMenu() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>

	<section class="products">
		<h2>Thumbnail Design</h2>
		<div class="all-products">
			<div class="product">
				<img src="images/gaming_thumbnail.jpg">
				<div class="product-info">
					<h4 class="product-title">Gaming Thumbnail Design
					</h4>
                                    <br>
                                    <p><b>$19/-</b></p>
                                    <a class="product-btn" href="gaming_thumbnail_order.php"><b>Buy Now</b></a>

				</div>
			</div>
			<div class="product">
                            <img src="images/Formal_thumbnail.jpg" width="130%">
				<div class="product-info">
					<h4 class="product-title">Formal Thumbnail Design
					</h4>
                                    <br>
                                    <p><b>$19/-</b></p>

                                    <a class="product-btn" href="formal_thumbnail_order.php"><b>Buy Now</b></a>

				</div>
			</div>
			<div class="product">
				<img src="images/custom_thumbnail.jpg">
				<div class="product-info">
					<h4 class="product-title">Custom Thumbnail Design
					</h4>
                                    <br>
                                    <p><b>$29/-</b></p>
                                    <a class="product-btn" href="custom_thumbnail_order.php"><b>Buy Now</b></a>

				</div>
			</div>
		</div>
	</section>

</body>
</html>