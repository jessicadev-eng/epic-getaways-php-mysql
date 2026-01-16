<?php
//Start the session
session_start();
include 'cart.php';
$cart = new Cart();
$counter = $_SESSION['counter'];
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EPIC GETAWAYS - Order Summary</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>EPIC GETAWAYS - Order Summary</h1>
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
<?php
//check whether the cart is empty or not
if ($counter == 0)
    echo"<br><br><p><b> Your Shopping Cart is empty !!! </b></p>";
else {
    $cart = unserialize($_SESSION['cart']);
    $depth = $cart->get_depth();
    echo"<h1>Shopping Cart</h1>";
    echo "<table class='cart-table'>";
    echo"<tr><th>Package Name</th><th>Quantity</th><th>Price</th></tr>";

	//Use a for loop to Iterate through the cart
    for ($i=0; $i < $depth; $i++) 
        {
        $package = $cart->get_package($i);
		$package_id = $package->get_package_id();
		$package_name = $package->get_package_name();
		$qty = $package->get_qty();
		$price = $package->get_price();
		//Calculate the total price
		$total_price = $total_price + $price;
		echo"<tr><td>$package_name</td><td>$qty</td><td>$" . number_format($price, 2) . "</td></tr>";
        }

    //Display the total price and store in a session
    $_SESSION["total_price"] = $total_price;
    echo "<tr><td><b>Total Price</b></td><td>&nbsp;</td><td><b>$" . number_format($total_price, 2) . "</b></td></tr>";
    echo "</table>";
    echo"<p><b><a class=cart-link href=view_cart.php>Remove prices from the Cart</a></b></p>";
    echo"<p><b><a class=cart-link href=payments.php>Proceed with Payments</a></b></p>";
    echo"<p><b><a class=cart-link href=packages.php>Go back to packages</a></b></p>";
}
?>
</main>
</body>
</html>
