<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username_db = "root";  // Replace 'root' with your DB username
$password_db = "";      // Replace '' with your DB password if any
$dbname = "test";       // Database name

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error variables and form fields
$emailErr = $passwordErr = "";
$email = $password = "";

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Email Validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Password Validation
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    // Check if all fields are valid before proceeding
    if (empty($emailErr) && empty($passwordErr)) {
        // Prepare and execute the query to check user credentials
        $stmt = $conn->prepare("SELECT password FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($dbPassword);
            $stmt->fetch();

            // Check if the entered password matches the one in the database
            if ($dbPassword === $password) {
                // Redirect to the dashboard or success page after login
                header("Location: home.html");
                exit();
            } else {
                $passwordErr = "Incorrect password";
            }
        } else {
            $emailErr = "No account found with this email";
        }

        // Close statement
        $stmt->close();
    }

// Close the connection
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            background-color: black;
            font-family:"Nico Moji";
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: white;
            
            background-image: url('Page2.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        form {
            background-color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
        }

        .input {
            border-radius: 10px;
            outline: 2px solid purple;
            border: 0;
            font-family:"Nico Moji";
            background-color: black;
            outline-offset: 3px;
            padding: 10px 1rem;
            transition: 0.25s;
            width: 90%;
            margin: 10px 0;
        }

        .input:focus {
            outline-offset: 5px;
            background-color: #fff;
        }

        .button {
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 98%;
            margin-top: 15px;
            outline: 2px solid purple;
            outline-offset: 3px;
            border-radius: 10px;
            font-family:"Nico Moji";
        }

        .button:hover {
            background-color: purple;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            form {
                padding: 15px;
                margin: 0 15px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Login</h1>

        Email: <input class="input" type="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>

        Password: <input class="input" type="password" name="password">
        <span class="error"><?php echo $passwordErr; ?></span>

        <input class="button" type="submit" value="Login">
    </form>
</body>
</html>
