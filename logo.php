<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logo Design</title>
	<link rel="stylesheet" type="text/css" href="style.css">
        <style>
            /* Base styles for the body */
        body {
            margin: 0;
            font-family:"Nico Moji";
        }
        </style>
</head>
<body>
    <?php include 'navbar.php';?>


	<section class="products">
		<h2>Logo Designs</h2>
		<div class="all-products">
			<div class="product">
				<img src="images/gaming.png">
				<div class="product-info">
					<h4 class="product-title">Gaming Logo Design
					</h4>
                                    <br>
                                    <p><b>$19/-</b></p>
                                    <a class="product-btn" href="gaming_logo_order.php"><b>Buy Now</b></a>

				</div>
			</div>
			<div class="product">
				<img src="images/formal.png">
				<div class="product-info">
					<h4 class="product-title">Formal Logo Design
					</h4>
                                    <br>
                                    <p><b>$19/-</b></p>

                                    <a class="product-btn" href="formal_logo_order.php"><b>Buy Now</b></a>

				</div>
			</div>
			<div class="product">
				<img src="images/custom.png">
				<div class="product-info">
					<h4 class="product-title">Custom Logo Design
					</h4>
                                    <br>
                                    <p><b>$29/-</b></p>
                                    <a class="product-btn" href="custom_logo_order.php"><b>Buy Now</b></a>

				</div>
			</div>
		</div>
	</section>

</body>
</html>