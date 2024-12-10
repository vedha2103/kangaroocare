<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webdev";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the lady ID from URL
$id = $_GET['id'];

// Query to get the lady's full profile based on the ID
$sql = "SELECT * FROM ladies WHERE id = $id";
$result = $conn->query($sql);
$lady = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lady['name']; ?>'s Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Confinement Lady Profile</h1>
    </header>

    <section class="lady-details">
        <h2><?php echo $lady['name']; ?></h2>
        <img src="image/<?php echo $lady['photo_url']; ?>" alt="Photo of <?php echo $lady['name']; ?>" class="lady-photo">
        <p><strong>Experience:</strong> <?php echo $lady['experience']; ?> years</p>
        <p><strong>Specialty:</strong> <?php echo $lady['specialty']; ?></p>
        <p><strong>Package Type:</strong> <?php echo $lady['package_type']; ?></p>
        <p><strong>Package Details:</strong> <?php echo $lady['package_details']; ?></p>
        <p><strong>Bio:</strong> <?php echo $lady['bio']; ?></p>
        <p><strong>Contact Info:</strong> <?php echo $lady['contact_info']; ?></p>
        <a href="booking.php?id=<?php echo $lady['id']; ?>">Book Now</a>
    </section>

</body>
</html>

<?php
$conn->close();
?>
