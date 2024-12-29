<?php
// Establish the database connection
require_once 'config/db.php'; 

// Initialize variables for email, new password, confirm password, and error message
$email = $new_password = $confirm_password = $error = "";

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form inputs (email, new password, and confirm password)
    $email = htmlspecialchars($_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // SQL query to check if a user exists with the provided email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql); // Execute the query

    // Check if a user is found with the provided email
    if ($result->num_rows > 0) {

        // Check if the new password and confirm password match
        if ($new_password === $confirm_password) {

            // Hash the new password before storing it in the database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // SQL query to update the user's password in the database
            $update_sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";

            // Execute the update query and check if it is successful
            if ($conn->query($update_sql) === TRUE) {
                // If password update is successful, display a success message and redirect to the login page
                echo "<script>
                    alert('Password reset successful! You can now log in with your new password.');
                    window.location.href = 'login.php';
                    </script>";
            } else {
                // If there is an error updating the password, display the error message
                $error = "Error updating password: " . $conn->error;
                $error = addslashes($error);

                // Display the error message and redirect back to the password reset page
                echo "<script>
                    alert('$error');
                    window.location.href = 'password.php';
                    </script>";
            }
        } else {
            // If the new password and confirm password do not match, display an alert and redirect back to the password reset page
            echo "<script>
                alert('Passwords do not match.');
                window.location.href = 'password.php';
                </script>";
        }
    } else {
        // If no user is found with the provided email, display an alert and redirect back to the password reset page
        echo "<script>
            alert('No account found with this email.');
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
            background: url('images/reset-pass.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
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
            gap: 15px;
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
    <!-- Logo section to display the website or application logo -->
    <div class="logo">
        <img src="images/logo.png" alt="Logo">
    </div>

    <!-- Heading for the Reset Password page -->
    <h1>Reset Password</h1>

    <!-- Form for resetting the password -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!-- Input field for entering the email address -->
        <input type="email" id="email" name="email" placeholder="Email" required>

        <!-- Input field for entering the new password -->
        <input type="password" id="new_password" name="new_password" placeholder="New Password" required>

        <!-- Input field for confirming the new password -->
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>

        <!-- Submit button to submit the password reset form -->
        <button type="submit" class="btn">Reset Password</button>
    </form>

    <!-- Footer section with a link to go back to the login page -->
    <div class="footer">
        Back to <a href="login.php">Login</a>
    </div>
</div>

</body>
</html>