<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username_db = "root";  // Replace with your database username
$password_db = "";      // Replace with your database password if any
$dbname = "test";       // Database name

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$name = $email = $phone = $message = "";
$nameErr = $emailErr = $messageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }

    $phone = test_input($_POST["phone"]);

    // If no errors, insert the data into the database
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $stmt = $conn->prepare("INSERT INTO contact (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

         // Execute the query
        if ($stmt->execute()) {
            // Close statement
            $stmt->close();
            // Close the connection
            $conn->close();
            // Redirect to success page after registration
            echo 'SUCCESSFUL';
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

// Sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family:"Nico Moji";
            background-color: black;
            color: white;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        .contact-us {
            text-align: center;
            margin-bottom: 40px;
        }
        .contact-us h1 {
            font-size: 2.5rem;
            color: #4a148c;
        }
        .contact-us p {
            font-size: 1.2rem;
            color: #555;
        }
        .contact-info {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        .info-item {
            background-color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px;
            max-width: 300px;
            flex-grow: 1;
        }
        .info-item h3 {
            margin-bottom: 15px;
            font-size: 1.5rem;
            color: #4a148c;
        }
        .info-item p {
            font-size: 1rem;
            color: #666;
        }
        .contact-form {
            background-color: black;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .contact-form form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            max-width: 48%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            background-color: black;
            color: white;
        }
        .contact-form textarea {
            max-width: 100%;
            min-height: 150px;
        }
        .contact-form input[type="submit"] {
            background-color: #4a148c;
            color: white;
            border: none;
            width: 100%;
            padding: 15px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-form input[type="submit"]:hover {
            background-color: #6a1b9a;
        }
        
        @media (max-width: 768px) {
            .contact-form input, .contact-form textarea {
                max-width: 100%;
            }
            .contact-info {
                flex-direction: column;
                align-items: center;
            }
            .info-item {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <section class="contact-us">
        <h1>Contact Us</h1>
        <p>We’d love to hear from you! Whether you have a question, need assistance, or just want to talk design, feel free to reach out.</p>
    </section>

    <section class="contact-info">
        <div class="info-item">
            <h3>Email</h3>
            <p>support@creativefusion.com</p>
        </div>
        <div class="info-item">
            <h3>Phone</h3>
            <p>+123 456 7890</p>
        </div>
        
    </section>

    <section class="contact-form">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="name" placeholder="Your Name" value="<?php echo $name; ?>" required>
            <span style="color:red;"><?php echo $nameErr; ?></span>
            <input type="email" name="email" placeholder="Your Email" value="<?php echo $email; ?>" required>
            <span style="color:red;"><?php echo $emailErr; ?></span>
            <input type="text" name="phone" placeholder="Your Phone Number" value="<?php echo $phone; ?>">
            <textarea name="message" placeholder="Your Message" required><?php echo $message; ?></textarea>
            <span style="color:red;"><?php echo $messageErr; ?></span>
            <input type="submit" value="Send Message">
        </form>
    </section>

    
</div>

</body>
</html>
