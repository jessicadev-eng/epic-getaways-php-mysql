<?php
//Start the session
session_start();
include 'cart.php';
$cart = new Cart();
$counter = $_SESSION['counter'];
require_once('conn_getawaysdb.php');
require_once('gen_id.php');

//Set the email
$email = "user@user.com";   
//if hte user is already logged in
//$email = $_SESSION["email];

if ($counter == 0) {
    echo "<br><br><p><b> Your Shopping Cart is empty !!! </b></p>";
} else {
    //Convert the cart string to a cart object
    $cart = unserialize($_SESSION['cart']);
    $depth = $cart->get_depth();
    //Generate the order id
    $order_id = gen_id(8);
    $total_price = 0;

    //Use a for loop to Iterate through the cart and calculate total
    for ($i = 0; $i < $depth; $i++) {
        $package = $cart->get_package($i);
        $total_price += $package->get_price();
    }

    //Add the record to order table
    $status = "Paid";
    //Create the insert query for the orders table
    $query = "insert into customer_order values (?,?,?,?)";
    try {
        $stmt = $mysqli->prepare($query);
        //Bind parameters
        $stmt->bind_param("ssds", $order_id, $email, $total_price, $status);
        //Execute the query
        $stmt->execute();
        echo "<p> <b>Order added......!!!! Order ID: $order_id </p>";
    } catch (Exception $e) {
        echo "<pre>";
        echo "Order ID: $order_id\n";
        echo "Error message: " . $e->getMessage();
        echo "</pre>";
        exit();
    }

    //Insert each package into order_details
    for ($i = 0; $i < $depth; $i++) {
        $package = $cart->get_package($i);
        $package_id = (int)$package->get_package_id();
        $qty = $package->get_qty();
        $price = $package->get_price();

        //Debug: verificar los valores antes de insertar
        //var_dump($package_id, $qty, $order_id);
        //exit();

        //Add the record to order_line table
        //Create the insert query for the order_details table
        $query = "insert into order_details(order_id, package_id, qty) values (?,?,?)";
        try {
            $stmt = $mysqli->prepare($query);
            //Bind the parameters
            $stmt->bind_param("sii", $order_id, $package_id, $qty);
            //Execute the query
            $stmt->execute();
        } catch (Exception $e) {
            echo "<pre>";
            echo "Order ID: $order_id\n";
            echo "Package ID: $package_id\n";
            echo "Qty: $qty\n";
            echo "Error message: " . $e->getMessage();
            echo "</pre>";
            exit();
        }
    }

    $message = "Thanks for your order, your order ID is $order_id";
    //Email or display the invoice
    //mail($email, "Order Confirmation", $message);
    echo $message;

    //Empty the cart
    $mysqli->close();
    unset($_SESSION['counter']);
    unset($_SESSION['cart']);
    echo "<p><b> <a href=packages.php>Go back to Packages </a> </b></p>";
}
?>
