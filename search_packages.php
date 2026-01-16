<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Packages</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function get_package(package_name) {
            if (package_name.length == 0) {
                document.getElementById("package_info").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("package_info").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "get_package.php?package_name=" + package_name, true);
                xmlhttp.send();
            }
        }
    </script>
</head>

<body>
    <header>
        <h1>EPIC GETAWAYS - Search Packages</h1>
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

    <main class="cart-container">
        <h2>Search for a Package</h2>
        <p>Enter part of the package name:</p>
        <input type="text" id="package_name" onkeyup="get_package(this.value)">
        <div id="package_info"></div>
    </main>

    <footer>
        <p>&copy; 2025 EPIC GETAWAYS. All rights reserved.</p>
    </footer>
</body>

</html>