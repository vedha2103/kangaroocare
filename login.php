<?php
// Establish database connection
require_once('config.php');

// Start a new session or resume an existing session
session_start();

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize and retrieve form inputs (username and password)
    $username = $conn->real_escape_string($_POST['username']);
    $password = trim($_POST['password']);

    // SQL query to search for the user in the database based on username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // Check if any user is found with the provided username
    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // Verify if the provided password matches the stored hashed password
        if (password_verify($password, $user['password'])) {
            // Store user information in session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect user based on their role
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            } elseif ($user['role'] === 'staff') {
                header("Location: staff_dashboard.php"); // Redirect to staff dashboard
            } else {
                header("Location: customer_dashboard.php"); // Redirect to customer dashboard
            }
            exit();
        } else {
            // If password is incorrect, show an alert and redirect back to login page
            echo "<script>
            alert('Invalid password.');
            window.location.href = 'login.php';
            </script>";
        }
    } else {
        // If no user is found with the provided username, show an alert and redirect back to login page
        echo "<script>
            alert('No user found with this username.');
            window.location.href = 'login.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
            background: url('images/log-in.jpg')
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
<body>

<div class="container">
    <!-- Section for the image or background -->
    <div class="image-section"></div>

    <!-- Form section for login -->
    <div class="form-section">
        <!-- Logo section, with some top margin applied to the image -->
        <div class="logo">
            <img src="images/logo.png" style="margin-top: 50px;" alt="Logo">
        </div>

        <!-- Heading for the login form -->
        <h1>Login Form</h1>

        <!-- Login form starts here -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Input field for the username -->
            <input type="text" id="username" name="username" placeholder="Username" required>

            <!-- Input field for the password -->
            <input type="password" id="password" name="password" placeholder="Password" required>

            <!-- Submit button to log the user in -->
            <button type="submit" class="btn">Login</button>
        </form>

        <!-- Footer section with links for password recovery and account registration -->
        <div class="footer">
            <a href="password.php">Forgot Password?</a><br><br>
            Don't have an account? <a href="signup.php">Register</a>
        </div>
    </div>
</div>

</body>
</html>