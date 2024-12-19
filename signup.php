<?php
require('config.php');

// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = $role = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validate username
    if (empty(trim($_POST['username']))) {
        $username_err = "**&nbsp;&nbsp;Please enter a username.";
    } else {
        $username = $conn->real_escape_string(trim($_POST['username']));
        // Check if username already exists
        $sql = "SELECT id FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $username_err = "**&nbsp;&nbsp;This username is already taken.";
        }
    }

    // Validate email
    if (empty(trim($_POST['email']))) {
        $email_err = "**&nbsp;&nbsp;Please enter an email.";
    } else {
        $email = $conn->real_escape_string(trim($_POST['email']));
        // Check if email already exists
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $email_err = "**&nbsp;&nbsp;This email is already registered.";
        }
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "**&nbsp;&nbsp;Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "**&nbsp;&nbsp;Password must be at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = "**&nbsp;&nbsp;Please confirm your password.";
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password !== $confirm_password) {
            $confirm_password_err = "**&nbsp;&nbsp;Passwords do not match.";
        }
    }

    // Check for errors before inserting into database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $role = $conn->real_escape_string($_POST['role']); // Store user's role
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Insert into database
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            alert('Register Successfully.');
            window.location.href = 'login.php';
            </script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
            gap: 10px;
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

        .invalid-feedback {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <h1>Register Form</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" id="username" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>

                <input type="email" id="email" name="email"placeholder="Email"  value="<?php echo htmlspecialchars($email); ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>

                <input type="password" id="password" name="password" placeholder="Password">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>

                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>

                <select id="role" name="role">
                    <option value="admin" <?php echo ($role === "admin") ? "selected" : ""; ?>>Admin</option>
                    <option value="staff" <?php echo ($role === "staff") ? "selected" : ""; ?>>Staff</option>
                    <option value="customer" <?php echo ($role === "customer") ? "selected" : ""; ?>>Customer</option>
                </select>

                <button type="submit" class="btn">Register</button>
            </form>

            <div class="footer">
                Already have an account? <a href="#">Login</a>
            </div>
        </div>
        <div class="image-section"></div>
    </div>

</body>
</html>