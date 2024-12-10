<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "webdev"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get Basic package ladies
$sql_basic = "SELECT * FROM ladies WHERE package_type = 'Basic'";
$result_basic = $conn->query($sql_basic);

// Query to get Premium package ladies
$sql_premium = "SELECT * FROM ladies WHERE package_type = 'Premium'";
$result_premium = $conn->query($sql_premium);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confinement Ladies</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Meet Our Confinement Ladies</h1>
    </header>

    <main class="container">
        <section class="package-section">
            <h2>Basic Package</h2>
            <div class="ladies-list">
                <?php while ($lady = $result_basic->fetch_assoc()) { ?>
                    <div class="lady-card">
                        <img src="image/<?php echo $lady['photo_url']; ?>" alt="Photo of <?php echo $lady['name']; ?>" class="lady-photo">
                        <div class="lady-info">
                            <h3><?php echo $lady['name']; ?></h3>
                            <p><strong>Experience:</strong> <?php echo $lady['experience']; ?> years</p>
                            <p><strong>Package:</strong> <?php echo $lady['package_type']; ?></p>
                            <p><strong>Details:</strong> <?php echo $lady['package_details']; ?></p>
                            <button onclick="window.location.href='view_profile.php?id=<?php echo $lady['id']; ?>'">View Profile</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section class="package-section">
            <h2>Premium Package</h2>
            <div class="ladies-list">
                <?php while ($lady = $result_premium->fetch_assoc()) { ?>
                    <div class="lady-card">
                        <img src="image/<?php echo $lady['photo_url']; ?>" alt="Photo of <?php echo $lady['name']; ?>" class="lady-photo">
                        <div class="lady-info">
                            <h3><?php echo $lady['name']; ?></h3>
                            <p><strong>Experience:</strong> <?php echo $lady['experience']; ?> years</p>
                            <p><strong>Package:</strong> <?php echo $lady['package_type']; ?></p>
                            <p><strong>Details:</strong> <?php echo $lady['package_details']; ?></p>
                            <button onclick="window.location.href='view_profile.php?id=<?php echo $lady['id']; ?>'">View Profile</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>

<?php
$conn->close();
?>
