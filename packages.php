<?php
// Start the session
session_start();

// Connect to the database
include_once('conn_getawaysdb.php');

// Create a select query to retrieve all packages
$query = "SELECT package_id, package_name, package_desc, price, image_name FROM package";
$stmt = $mysqli->prepare($query);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPIC GETAWAYS - Packages</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Our Travel Packages</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="packages.php">Packages</a></li>
                <li><a href="view_Cart.php">Cart</a></li>
                <li><a href="search_packages.php">Search</a></li>
                <?php
                // Mostrar el nombre del usuario si ha iniciado sesión
                if (isset($_SESSION['first_name'])) {
                    echo "<li><b>Welcome, " . htmlspecialchars($_SESSION['first_name']) . "</b></li>";
                    echo "<li><a href='logout.php'>Logout</a></li>";
                } else {
                    echo "<li><a href='register.html'>Register</a></li>";
                    echo "<li><a href='login.html'>Login</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Explore Our Travel Packages</h2>
        <div class="packages-grid">
        <?php
        // Loop through the result set and print each package
        while ($row = $result->fetch_assoc()) {
            $package_id = $row['package_id'];
            $package_name = $row['package_name'];
            $package_desc = $row['package_desc'];
            $price = $row['price'];
            $image_name = $row['image_name'];

            echo "<div class='package'>";
            echo "<form action='add_to_cart.php' method='POST'>";
            echo "<img src='images/$image_name' alt='$package_name'>";
            echo "<h3>$package_name</h3>";
            echo "<p>$package_desc</p>";
            echo "<p>Price: $" . number_format($price, 2) . "</p>";
            echo "<input type='hidden' name='package_id' value='$package_id'>";
            echo "<label for='qty'>Qty:</label>";
            echo "<input type='number' name='qty' value='1' min='1' class='qty-input'>";
            echo "<input type='submit' value='Add to Cart' class='add-to-cart'>";
            echo "</form>";
            echo "</div>";
        }
        $stmt->close();
        $mysqli->close();
        ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 EPIC GETAWAYS. All rights reserved.</p>
    </footer>
</body>
</html>
