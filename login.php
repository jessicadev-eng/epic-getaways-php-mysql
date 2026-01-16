<?php
//start the new session
session_start();
//Read the email and the password
$email = $_POST['email'];
$password=$_POST['password'];
if (($email=="") || ($password=="")) {
   //Redirect user back to the login page
   header("Location:login.html");
   exit();
}
else
	{   
	//connect to server and select database
	require_once('conn_getawaysdb.php');
	$key = "12356abdefg";
	$password = crypt($password, $key);
	//Create a select query to select user details using the email and the password
	$query = "select * from customer where (email = ?) and (password = ?)";
    //Bind the parameters
	$stmt = $mysqli -> prepare($query);
	$stmt -> bind_param("ss", $email, $password);
	//Execute the query
	$stmt -> execute();
	$result = $stmt -> get_result();
	//print_r($result);
	//Close the connection
	$mysqli -> close();

	//get the number of rows in the result set; should be 1 if a match
	if ($result->num_rows == 1) {
   		//if authorized, get the values of firstname lastname, phone and email
		$row = $result -> fetch_array();
    	
		//save the values in session variables
		$_SESSION['first_name'] = $row['first_name'];
		$_SESSION['last_name'] = $row['last_name'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['phone_number'] = $row['phone_number'];
		$_SESSION['address'] = $row['address'];

		//Read the values from the session	
    	$first_name = $_SESSION['first_name'];
    	$last_name = $_SESSION['last_name'];
    	//$phone_number = $_SESSION['phone_number'];
    	//$email = $_SESSION['email'];
		//$address = $_SESSION['address'];
		//echo"<h2> Authentication Succeed !!! </h2>";
		//Display a welcome message
    	//echo "<h3>Welcome back $first_name $last_name </h3>";
    	//echo "Email: $email </br>";
    	//echo "Phone number: $phone_number </br>";
    	//echo "Address: $address</br>";
		//echo"<a href=packages.php> Click Here to go to Packages Page </a>"; 
		echo "<script>
        alert('Welcome back $first_name $last_name!');
        window.location.href = 'packages.php';
        </script>";
	}
	else
		{
			//Redirect user back to the login page
			//header("Location:register.html");
			//exit();
			//Credentials incorrect
			echo "<h3>Incorrect email or password.</h3>";
			echo "<a href=login.html> Click Here to Log In </a>";
			exit();
		}
}
?>
