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

    // Phone Validation
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
        // Hash the password before saving
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO registration (name, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $username, $email, $phone, $password);

        // Execute the query
        if ($stmt->execute()) {
            echo "<p>Registration successful!</p>";
        } else {
            echo "Error: " . $stmt->error;
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
    <title>Registration Form</title>
    <style>
        input {
  border-radius: 10px;
  outline: 2px solid #9b55b7;
  border: 0;
  font-family:"Nico Moji";
  background-color: #171717;
  outline-offset: 4px;
  padding: 10px 1rem;
  transition: 0.25s;
  
  display: block;
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  color: white;
  
}
.button{
    width: 105%;
}

input:focus {
  outline-offset: 5px;
  background-color: #fff;
    font-family:"Nico Moji";

}
        form {
            max-width: 400px;
            margin: 0 auto;
              font-family:"Nico Moji";

        }
        
        .error {
            color: red;
        }
        body{
            background-image: url('Page2.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: white;
            font-family:"Nico Moji";

        

        }
    </style>
</head>
<body>
    <h1 align="center">Registration Form</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
        
        Username: <input type="text" name="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo $usernameErr; ?></span>
        
        E-mail: <input type="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
        
        Phone Number: <input type="text" name="phone" value="<?php echo $phone; ?>">
        <span class="error"><?php echo $phoneErr; ?></span>
        
        Password: <input type="password" name="password">
        <span class="error"><?php echo $passwordErr; ?></span>
        
        Confirm Password: <input type="password" name="confirm_password">
        <span class="error"><?php echo $confirmPasswordErr; ?></span>
        <br>
        <input class="button" type="submit" value="Sign Up" style=" color: white;">
    </form>
</body>
</html>
