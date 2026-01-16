<?php
// Get the package name from the query string
$package_name = $_GET["package_name"];
$info = "";

// Connect to the database
include_once("conn_getawaysdb.php");

// Prepare SQL query using LIKE for partial matching
$query = "SELECT package_id, package_name, package_desc, price, image_name FROM package WHERE package_name LIKE ?";
$stmt = $mysqli->prepare($query);
$package_name = "%" . $package_name . "%";
$stmt->bind_param("s", $package_name);
$stmt->execute();

// Get results
$result = $stmt->get_result();

// Check and display packages
if ($result->num_rows != 0) {
    while ($row = $result->fetch_assoc()) {
        $package_id = $row["package_id"];
        $name = $row["package_name"];
        $desc = $row["package_desc"];
        $price = $row["price"];
        $image = $row["image_name"];

        $info .= "<div class='package'>";
        $info .= "<form action='add_to_cart.php' method='POST'>";
        $info .= "<img src='images/$image' alt='$name'>";
        $info .= "<h3>$name</h3>";
        $info .= "<p>$desc</p>";
        $info .= "<p>Price: $" . number_format($price, 2) . "</p>";
        $info .= "<input type='hidden' name='package_id' value='$package_id'>";
        $info .= "<label for='qty'>Qty:</label>";
        $info .= "<input type='number' name='qty' value='1' min='1' class='qty-input'>";
        $info .= "<input type='submit' value='Add to Cart' class='add-to-cart'>";
        $info .= "</form>";
        $info .= "</div>";
    }
} else {
    $info = "<p>No matching packages found.</p>";
}

$mysqli->close();
echo $info;
?>
