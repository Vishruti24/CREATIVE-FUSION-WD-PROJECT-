<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username_db = "root"; // Replace 'root' with your DB username
$password_db = "";     // Replace '' with your DB password if any
$dbname = "test";      // Database name

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error variables and form fields
$nameErr = $usernameErr = $emailErr = $phoneErr = $passwordErr = $confirmPasswordErr = "";
$name = $username = $email = $phone = $password = $confirmPassword = "";

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name Validation
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Username Validation
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
            $usernameErr = "Username can only contain letters, numbers, and underscores.";
        }
    }

    // Email Validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

   /* Phone Validation*/
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "Phone number must be exactly 10 digits";
        }
    }

    // Password Validation
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        // Password strength checks
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters long";
        } elseif (!preg_match("/[A-Z]/", $password)) {
            $passwordErr = "Password must contain at least one uppercase letter";
        } elseif (!preg_match("/[a-z]/", $password)) {
            $passwordErr = "Password must contain at least one lowercase letter";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $passwordErr = "Password must contain at least one number";
        } elseif (!preg_match("/[\W]/", $password)) {
            $passwordErr = "Password must contain at least one special character (e.g., !@#$%^&*)";
        }
    }

    // Confirm Password Validation
    if (empty($_POST["confirm_password"])) {
        $confirmPasswordErr = "Confirm password is required";
    } else {
        $confirmPassword = test_input($_POST["confirm_password"]);
        if ($confirmPassword !== $password) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    // Check if all fields are valid before proceeding
    if (empty($nameErr) && empty($usernameErr) && empty($emailErr) && empty($phoneErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        // No password hashing, storing plain text
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO registration (name, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $username, $email, $phone, $password);

        // Execute the query
        if ($stmt->execute()) {
            // Close statement
            $stmt->close();
            // Close the connection
            $conn->close();
            // Redirect to success page after registration
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Registration Form</title>
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
            width: 100%;
            
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

        @media (max-width: 800px) {
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
        <h1>Registration Form</h1>

        Name: <input class="input" type="text" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>

        Username: <input class="input" type="text" name="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo $usernameErr; ?></span>

        Email: <input class="input" type="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>

        Phone: <input class="input" type="text" name="phone" value="<?php echo $phone; ?>">
        <span class="error"><?php echo $phoneErr; ?></span>

        Password: <input class="input" type="password" name="password">
        <span class="error"><?php echo $passwordErr; ?></span>

        Confirm Password: <input class="input" type="password" name="confirm_password">
        <span class="error"><?php echo $confirmPasswordErr; ?></span>
        <br>
        <input class="button" type="submit" value="Sign Up">
    </form>
</body>
</html>
