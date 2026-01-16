<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPIC GETAWAYS - Home</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
</head>
<body>
    <header>
        <h1>Welcome to EPIC GETAWAYS</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="packages.php">Packages</a></li>
                <li><a href="view_Cart.php">Cart</a></li>
                <li><a href="search_packages.php">Search</a></li>
                <?php
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
        <h2>Explore Our Destinations</h2>
        <div class="carousel">
            <div class="carousel-container">
                <div class="carousel-slide"><img src="images/sydney_hor.jpg" alt="Sydney"></div>
                <div class="carousel-slide"><img src="images/tasmania_hor.jpg" alt="Tasmania"></div>
                <div class="carousel-slide"><img src="images/ghan.jpg" alt="Ghan"></div>
                <div class="carousel-slide"><img src="images/perth_hor.jpg" alt="Perth"></div>
                <div class="carousel-slide"><img src="images/cliffs.jpg" alt="Nature cliffs"></div>
            </div>
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 EPIC GETAWAYS. All rights reserved.</p>
    </footer>
</body>
</html>
