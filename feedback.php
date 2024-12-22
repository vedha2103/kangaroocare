<?php
// Include the database configuration
require_once 'config/db.php';
include("config/auth.php");

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

<style>
/* Body styling */
body {
    font-family: 'Arial', sans-serif; /* Changed to a more readable sans-serif font */
    background: linear-gradient(to right, #000428, #004e92);
    color: #fff; /* White text for better contrast */
    line-height: 1.6;
    margin: 0;
    padding: 0;
}

/* Header styling */
header {
    background: linear-gradient(to right, #000428, #004e92); /* Matching the existing gradient background */
    color: #fff; /* White text to stand out on the dark background */
    text-align: center;
    padding: 2rem; /* Increased padding for more space */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* Subtle shadow for a sense of depth */
    border-radius: 15px; /* Rounded corners for a smoother feel */
    font-family: 'Arial', sans-serif; /* Clearer, modern font */
}

/* Header title */
header h1 {
    font-size: 3rem; /* Larger size for emphasis */
    font-weight: bold;
    color: #fff; /* White text to contrast with the dark background */
    letter-spacing: 2px;
    text-transform: uppercase; /* Uppercase for a modern, impactful look */
    margin: 0;
}

/* Main content styling */
section {
    max-width: 800px;
    margin: 3rem auto; /* Centered content */
    padding: 1.5rem;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background for the content area */
    border-radius: 10px;
}

/* Feedback form styling */
form {
    display: flex;
    flex-direction: column;
    gap: 1rem; /* Space between form elements */
    margin-bottom: 1.5rem;
}

/* Textarea styling */
textarea {
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ccc;
    resize: vertical; /* Allow the user to resize the textarea vertically */
    min-height: 100px;
    background-color: #f9f9f9; /* Light background for the text area */
}

/* Submit button styling */
input[type="submit"] {
    padding: 12px 20px;
    font-size: 1rem;
    background-color: #004e92; /* Consistent button color */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #002d6d; /* Darker shade on hover */
}

/* Feedback messages styling */
p {
    font-size: 1.1rem;
    margin-top: 1rem;
}

p[style*="color: red;"] {
    color: #f44336; /* Red for error messages */
}

p[style*="color: green;"] {
    color: #4CAF50; /* Green for success messages */
}

/* All feedback section styling */
h3 {
    font-size: 1.8rem;
    margin-top: 2rem;
    text-align: center;
    color: #fff; /* Light color for headings */
    text-transform: uppercase;
}

strong {
    color: #ffd700; /* Golden color for usernames */
}

em {
    color: #ccc; /* Lighter color for date */
}

/* Style for the feedback list */
section p {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

section em {
    display: block;
    margin-top: 0.5rem;
    font-style: italic;
    font-size: 0.9rem;
    color: #b3b3b3;
}

/* Add responsiveness for smaller screens */
@media (max-width: 600px) {
    body {
        font-size: 14px;
    }

    header h1 {
        font-size: 2.5rem;
    }

    form {
        margin: 0 1rem;
    }

    textarea {
        width: 100%;
    }

    input[type="submit"] {
        width: 100%;
    }

    section {
        margin: 1rem;
        padding: 1rem;
    }
}

</style>

<body>

<header>
    <h1>Feedback</h1>
</header>


<section>
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
</section>

</body>
</html>