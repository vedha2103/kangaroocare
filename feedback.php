<?php
// Include the database configuration
require_once 'config.php';

// Start the session
session_start();

// Initialize variables
$error_message = "";
$success_message = "";

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    
    // Handle the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION["id"];
        $feedback = trim($_POST["feedback"]);

        // Check if the feedback is empty
        if (empty($feedback)) {
            $error_message = "Please enter your feedback.";
        } else {
            // Insert the feedback into the database
            $sql = "INSERT INTO feedback (user_id, feedback, created_at) VALUES (?, ?, NOW())";

            // Prepare the SQL statement
            $stmt = mysqli_prepare($link, $sql);
            if ($stmt) {
                // Bind the parameters to the SQL query
                mysqli_stmt_bind_param($stmt, "is", $user_id, $feedback);

                // Execute the query
                if (mysqli_stmt_execute($stmt)) {
                    $success_message = "Your feedback has been submitted successfully!";
                } else {
                    $error_message = "Something went wrong, please try again.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                $error_message = "Database error: Could not prepare statement.";
            }
        }
    }
} else {
    // If the user is not logged in
    $error_message = "You must be logged in to submit feedback.";
}

// Retrieve all feedback from the database
$sql = "SELECT f.feedback, u.username, f.created_at FROM feedback f JOIN users u ON f.user_id = u.id ORDER BY f.created_at DESC";
$result = mysqli_query($link, $sql);

// Close the database connection
mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
</head>
<body>

<h2>Feedback</h2>

<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
    <!-- Feedback form for logged-in users -->
    <form action="feedback.php" method="post">
        <textarea name="feedback" rows="5" cols="40" placeholder="Enter your feedback here"></textarea>
        <br>
        <input type="submit" value="Submit Feedback">
    </form>
    <p style="color: red;"><?php echo $error_message; ?></p>
    <p style="color: green;"><?php echo $success_message; ?></p>
<?php else: ?>
    <p>You must be logged in to submit feedback.</p>
<?php endif; ?>

<h3>All Feedback</h3>

<?php
// Display all feedback from the database
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p><strong>" . htmlspecialchars($row['username']) . ":</strong> " . htmlspecialchars($row['feedback']) . "<br>";
        echo "<em>Posted on: " . $row['created_at'] . "</em></p>";
    }
} else {
    echo "<p>No feedback available.</p>";
}

// If feedback submission was successful, show a JavaScript alert
if ($success_message) {
    echo "<script>alert('$success_message');</script>";
}

?>

</body>
</html>