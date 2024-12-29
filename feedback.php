<?php
// Include the database connection file
require_once 'config/db.php';
require_once 'config/auth.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']) && isset($_SESSION['role']);

// Handle feedback form submission for logged-in users
if ($isLoggedIn && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the input to prevent SQL injection
    $feedback = $conn->real_escape_string($_POST['feedback']);
    $username = $_SESSION['username'];

    // Insert the feedback into the 'feedback' table in the 'users' database
    $sql = "INSERT INTO feedback (username, feedback) VALUES ('$username', '$feedback')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Feedback submitted successfully.'); window.location.href = 'feedback.php';</script>";
    } else {
        echo "<script>alert('Error submitting feedback.'); window.location.href = 'feedback.php';</script>";
    }
}

// Fetch all feedback from the 'feedback' table in the 'users' database
$sql = "SELECT * FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Georgia, 'Times New Roman', Times, serif;
        }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(to right, #000428, #004e92);
        
    }

    header {
        color: #fff;
        text-align: center;
        padding: 2rem 0;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        
    }

    header h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #fff;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

</style>
</head>
<body>
    <header>
        <h1>Feedback</h1>
    </header>

    <div class="container">
    <?php if ($isLoggedIn): ?>
        <!-- Feedback form visible only to logged-in users -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <textarea name="feedback" placeholder="Enter your feedback here..." required></textarea>
            <button type="submit">Submit Feedback</button>
        </form>
    <?php else: ?>
        <p>You need to be logged in to submit feedback. <a href="login.php">Login here</a>.</p>
    <?php endif; ?>

        <h3>All Feedback</h3>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($feedback = $result->fetch_assoc()): ?>
                    <strong><?php echo htmlspecialchars($feedback['username']); ?>:</strong>
                    <p><?php echo nl2br(htmlspecialchars($feedback['feedback'])); ?></p>
                    <small><i>Created at: <?php echo $feedback['created_at']; ?></i></small>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No feedback available.</p>
        <?php endif; ?>
    </div>

</body>
</html>