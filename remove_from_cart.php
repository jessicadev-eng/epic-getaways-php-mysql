<?php
//Start the session
session_start();
include 'cart.php';

$package_no = $_POST['package_no'];
//remove package from the cart if selected - mark as deleted
//If the package is not empty
if ($package_no !="") {

    $counter = $_SESSION['counter'];
    $cart = new Cart();
    $cart = unserialize($_SESSION['cart']);

    //delete selected product from the cart
    $cart->delete_package($package_no);

    //update the counter
    //Decrement the counter by one
    $_SESSION['counter'] = $counter - 1; 
	
	//Serialize and add back to the session
    $_SESSION['cart'] = serialize($cart);

    //Redirect to the view_cart.php
    header("Location:view_cart.php");
    exit();
}
	
?>