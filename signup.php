<?php
// Establish database connection
require('config/db.php');

// Initialize variables to store form inputs and error messages
$username = $email = $password = $confirm_password = $role = $error = "";

// Check if the form is submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize and assign form input values to variables
    $username = $conn->real_escape_string(trim($_POST['username']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = $conn->real_escape_string($_POST['role']);

    // Hash the password for secure storage
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert user data into the `users` table
    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')";

    // Execute the query and check if the insertion is successful
    if ($conn->query($sql) === TRUE) {
        // On successful registration, show an alert and redirect to the login page
        echo "<script>
        alert('Register Successfully.');
        window.location.href = 'login.php';
        </script>";
        exit();
    } else {
        // Handle database insertion errors and prepare error message
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $error = addslashes($error);

        // Display the error message and redirect back to the password page
        echo "<script>
            alert('$error');
            window.location.href = 'password.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #000000, #3533CD);
        }

        .container {
            display: flex;
            width: 1200px;
            height: 650px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }

        .form-section {
            flex: 0.8;
            padding: 30px;
        }

        .image-section {
            flex: 1;
            background: url('images/sign-up.jpg')
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .footer a {
            color: #0000EE;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-section">
        <!-- Logo section -->
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        
        <!-- Heading for the registration form -->
        <h1>Register Form</h1>

        <!-- Form for user registration -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Input field for username -->
            <input type="text" id="username" name="username" placeholder="Username" required>

            <!-- Input field for email -->
            <input type="email" id="email" name="email" placeholder="Email" required>

            <!-- Input field for password -->
            <input type="password" id="password" name="password" placeholder="Password" required>

            <!-- Input field for confirming password -->
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>

            <!-- Dropdown select for user role -->
            <select id="role" name="role">
                <!-- Option for Admin role, selected if $role is 'admin' -->
                <option value="admin" <?php echo ($role === "admin") ? "selected" : ""; ?>>Admin</option>

                <!-- Option for Staff role, selected if $role is 'staff' -->
                <option value="staff" <?php echo ($role === "staff") ? "selected" : ""; ?>>Staff</option>

                <!-- Option for Customer role, selected if $role is 'customer' -->
                <option value="customer" <?php echo ($role === "customer") ? "selected" : ""; ?>>Customer</option>
            </select>

            <!-- Submit button for registration form -->
            <button type="submit" class="btn">Register</button>
        </form>

        <!-- Footer section with a link to the login page if user already has an account -->
        <div class="footer">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
    
    <!-- Section for additional image or design -->
    <div class="image-section"></div>
</div>

</body>
</html>