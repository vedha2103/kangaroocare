<?php
require_once 'config/db.php';
require_once 'config/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = $conn->real_escape_string($_POST['feedback']);
    $username = $_SESSION['username'];

    $sql = "INSERT INTO feedback (username, feedback) VALUES ('$username', '$feedback')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Feedback submitted successfully.'); window.location.href = 'feedback.php';</script>";
    } else {
        echo "<script>alert('Error submitting feedback.'); window.location.href = 'feedback.php';</script>";
    }
}

$sql = "SELECT * FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            min-height: auto;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #000428, #004e92);
        }

        header {
            background-color: #ccc;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #e0e0e0;
            padding: 10px;
            text-align: center;
        }

        .container{
            max-width: 1200px;
            margin: 0px auto;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .container h2{
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
        }

        .feedback-section {
            margin: 20px;
            text-align: center;
        }

        .textarea-container {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 100px;
            resize: none;
            padding: 10px;
            font-size: 14px;
        }

        button {
            padding: 5px 65px;
            font-size: 14px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: right;
        }

        button:hover {
            background-color: #0056b3;
        }

        .comment-container {
            max-width: 1148px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #767676;
        }

        .comment-container h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .comment-bar {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .comment {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fdfdfd;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .comment-container .comment:last-child {
            margin-bottom: 0;
        }

        .comment .username {
            font-weight: bold;
            color: #007bff; 
            margin-bottom: 10px;
        }

        .comment .comment-text {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .comment .created_at {
            font-size: 12px;
            color: #999;
            text-align: right;
        }

        footer {
            background-color: #ccc;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>Header</header>
    <nav>Navigation Bar</nav>

    <div class="container">
        <div class="feedback-section">
            <h2>Feedback</h2>
            <div class="textarea-container">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <textarea name="feedback" placeholder="Enter your feedback..."></textarea>
            </div>
            <button type="submit">Submit Feedback</button>
            </form>
        </div>

        <div class="comment-container">
            <h3>Comments</h3>
            <div class="comment-bar">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($feedback = $result->fetch_assoc()): ?>
                        <div class="comment">
                            <div class="username"><?php echo htmlspecialchars($feedback['username']); ?>:</div>
                            <div class="comment-text"><?php echo nl2br(htmlspecialchars($feedback['feedback'])); ?></div>
                            <div class="created_at"><?php echo $feedback['created_at']; ?></div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No feedback available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer>Footer</footer>
    
</body>
</html>