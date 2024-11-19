<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Thumbnail Design</title>
    <style>
        body {
            font-family:"Nico Moji";
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-color: black;
            color: white;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: black;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: white;
        }

        /* Image Slider Styles */
        .slider-container {
            position: relative;
            max-width: 20%;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 10px;
            color: white;
        }

        .slides {
            display: flex;
            width: 100%; /* Total width for 3 images (100% each) */
            transition: transform 0.5s ease-in-out; /* Apply transition effect */
        }

        .slides img {
            width: 100%; /* Each image takes 100% of the container's width */
            height: auto;
            max-height: 400px; /* Optional max height */
        }

        /* Navigation buttons */
        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .prev, .next {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            cursor: pointer;
            border: none;
            font-size: 18px;
            border-radius: 50%;
        }

        /* Slider Caption */
        .slider-caption {
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
            color: white;
        }

        /* Text Area for Request */
        textarea {
            width: 95%;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            background-color: black;
            color: white;
        }

        /* Order Button */
        .order-btn {
            background-color: #45ffc7;
            color: white;
            padding: 15px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }

        .order-btn:hover {
            background-color: #6a00b0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .slides img {
                max-height: 250px;
                width: 100%; /* Make images responsive for smaller screens */
            }
        }

    </style>
</head>
<body>
<?php include 'navbar.php';?>

    <div class="container">
        <h1>Order Thumbnail Design</h1>

        <!-- Image Slider -->
        <div class="slider-container">
            <div class="slides">
                <img src="images/gaming_Thumbnail_1.jpg" alt="Thumbnail 1">
                <img src="images/gaming_Thumbnail_2.jpg" alt="Thumbnail 2">
                <img src="images/gaming_Thumbnail_3.jpg" alt="Thumbnail 3">
            </div>
            <div class="slider-nav">
                <button class="prev" onclick="moveSlider(-1)">&#10094;</button>
                <button class="next" onclick="moveSlider(1)">&#10095;</button>
            </div>
            <div class="slider-caption">Logo 1</div>
        </div>

        <!-- Text Area for User Request -->
        <label for="request">Your Request:</label>
        <textarea id="request" rows="6" placeholder="Please select the template and describe your Thumbnail design request here..."></textarea>

        <!-- Order Button -->
        <button class="order-btn">Place Order</button>
    </div>

    <script>
        let slideIndex = 0;
        const slides = document.querySelector('.slides');
        const captions = ["Thumbnail 1", "Thumbnail 2", "Thumbnail 3"];
        const captionElement = document.querySelector('.slider-caption');

        function moveSlider(direction) {
            const totalSlides = captions.length;
            slideIndex = (slideIndex + direction + totalSlides) % totalSlides;
            slides.style.transform = `translateX(-${slideIndex * (300 / totalSlides)}%)`;  // Shift by 100% divided by the total number of images
            captionElement.textContent = captions[slideIndex];
        }

        // Initialize first slide
        moveSlider(0);
    </script>

</body>
</html>
