<?php
//Start the session
session_start();
include 'cart.php';
$cart = new Cart();
$counter = isset($_SESSION['counter']) ? $_SESSION['counter'] : 0;
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPIC GETAWAYS - Cart</title>
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
        <h1>Shopping Cart</h1>

        <?php
        if ($counter == 0) {
            //Display message if cart is empty
            echo "<p><b>Your Shopping Cart is empty !!!</b></p>";
            echo "<p><b><a class='cart-link' href='packages.php'>Go back to packages</a></b></p>";
        } else {
            //Unserialize the cart and get items
            $cart = unserialize($_SESSION['cart']);
            $depth = $cart->get_depth();
            $total = 0;

            //Start cart table
            echo "<table class='cart-table'>";
            echo "<tr>
                    <th>Package Name</th>
                    <th>Quantity</th>
                    <th>Price Each</th>
                    <th>Subtotal</th>
                    <th>Remove</th>
                  </tr>";

            //Loop through the cart
            for ($i = 0; $i < $depth; $i++) {
                $package = $cart->get_package($i);
                $package_name = $package->get_package_name();
                $qty = $package->get_qty();
                $price_each = $package->get_price() / $qty;
                $subtotal = $package->get_price();
                $total += $subtotal;

                echo "<tr>";
                echo "<td>$package_name</td>";
                echo "<td>$qty</td>";
                echo "<td>\$" . number_format($price_each, 2) . "</td>";
                echo "<td>\$" . number_format($subtotal, 2) . "</td>";
                echo "<td>
                        <form action='remove_from_cart.php' method='POST'>
                            <input type='hidden' name='package_no' value='$i'>
                            <input class='remove-btn' type='submit' name='remove' value='Remove'>
                        </form>
                      </td>";
                echo "</tr>";
            }

            //Total row
            echo "<tr><td colspan='3'><b>Total</b></td><td colspan='2'><b>\$" . number_format($total, 2) . "</b></td></tr>";
            echo "</table>";

            //Checkout links
            echo "<p><b><a class='cart-link' href='checkout.php'>Checkout</a></b></p>";
            echo "<p><b><a class='cart-link' href='packages.php'>Go back to Packages</a></b></p>";
        }
        ?>
    </main>
</body>
</html>
