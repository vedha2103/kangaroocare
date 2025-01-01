<?php
require_once 'config/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $conn->real_escape_string($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: homepage.php");
            } elseif ($user['role'] === 'staff') {
                header("Location: homepage.php");
            } else {
                header("Location: homepage.php");
            }
            exit();
        } else {
            echo "<script>
            alert('Invalid password.');
            window.location.href = 'login.php';
            </script>";
        }
    } else {
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
            background: linear-gradient(to right, #000428, #004e92);
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
    <div class="image-section"></div>

    <div class="form-section">
        <div class="logo">
            <img src="images/logo.png" style="margin-top: 50px;" alt="Logo">
        </div>

        <h1>Login Form</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>

        <div class="footer">
            <a href="password.php">Forgot Password?</a><br><br>
            Don't have an account? <a href="signup.php">Register</a>
        </div>
    </div>
</div>

</body>
</html>