<?php
//Start the session
session_start();
include 'cart.php';


//Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "<h3>You must be logged in to add packages to the cart.</h3>";
    echo "<a href='login.html'>Click here to log in</a>";
    exit();
}
//get the package_id
$package_id= $_POST["package_id"];
$qty = isset($_POST["qty"]) ? (int)$_POST["qty"] : 1;

//store number of packages in the shopping cart
$counter = $_SESSION['counter'];
$cart = new Cart();

//unserialize the cart if the cart is not empty
if ((isset($_SESSION['counter'])) && ($_SESSION['counter'] !=0)){
    $counter = $_SESSION['counter']; 
	//	unserialize convert the session object which is a string to a cart object
	$cart = unserialize($_SESSION['cart']);
}  
else {
	$_SESSION['counter'] = 0;
	$_SESSION['cart'] = "";
}

//If empty
if (($package_id == "") or ($qty < 1))
{
   //Redirect the user back to package page
   header("Location:packages.php");
   exit();
}
else
{
	//connect to server and select database
	include_once("conn_getawaysdb.php");
	
	//Create a select query to retrive the selected package
	$query = "SELECT package_name, package_desc, price, image_name FROM package where (package_id = ?)";
    //Run the mysql query
    $stmt = $mysqli->prepare($query);
	$stmt->bind_param("s", $package_id);
	$stmt->execute();
	$result = $stmt->get_result();
    //If there is a matching recored select package details
	if(mysqli_num_rows($result) == 1)
	{
		$row = $result->fetch_assoc();
        $package_name = $row["package_name"];
        $package_desc = $row["package_desc"];
        $price = $row["price"];
        $image_name = $row["image_name"];

		// Create a new Package object
        $new_package = new Package($package_id, $package_name, $package_desc, $price, $image_name, $qty);

		//Check wether package exists, if exists then update the quantity, if not add as a new item
		$exists = false;
		for ($i = 0; $i < $cart->get_depth(); $i++) 
		{
    		$existing = $cart->get_package($i);
    		if ($existing->get_package_id() == $package_id) 
			{
        		$cart->update_qty($package_id, $qty);
        		$exists = true;
        		break;
    		}
		}

		if (!$exists) 
		{
    		$cart->add_package($new_package);
    		$_SESSION['counter'] = $counter + 1;
		}

        //serialize the cart object to store  in session
        $_SESSION['cart'] = serialize($cart);

        //Close the conection and redirect
		$mysqli->close();
		header("Location:view_cart.php");
		exit();

		//print_r($cart); // car object (unserialize)
		//print_r($_SESSION['cart']);//serialize object

    }
    else
    {
		//Redirect to back to the package page
		$mysqli->close();
		header("Location:packages.php");
   		exit();
    }
	$mysqli->close();
}
?>
