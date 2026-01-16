<?php
//Capture the user inputs from the form
//Read first name from the form
$first_name = filter_var($_POST['first_name']);
//Read last name from the form
$last_name = filter_var($_POST['last_name']);
//Read email from the form
$email = filter_var($_POST['email']);
//Read tel. no. from the form
$phone_number = filter_var($_POST['phone_number']);
//Read address from the form
$address = filter_var($_POST['address']);
//Read password from the form
$password = filter_var($_POST['password']);
//Read re-password from the form
$repassword = filter_var($_POST['repassword']);

//Validate user inputs

if (($first_name == "") or ($last_name == "") or ($email == "") or ($phone_number == "") or ($address == "") or ($password == "")) {
  //Error message to the user
  echo "Missing required fields";
} elseif (!(strstr($email, "@")) or !(strstr($email, "."))) {
  //Error message to the user
  echo "Please enter a correct email";
} elseif (!(is_numeric($phone_number))) {
  //Error message to the user
  echo ("Phone number is not numeric");
} elseif ($password != $repassword) {
  //Error message to the user 
  echo "Password does not match, re-enter the password";
} else {
  //Connect to the server and add a new record 
  require_once('conn_getawaysdb.php');

  //Check if email already exists in the database
  $checkQuery = "SELECT * FROM customer WHERE email = ?";

  //Prepare the SQL statement
  $checkStmt = $mysqli->prepare($checkQuery);

  //Bind the email parameter to the prepared statement
  $checkStmt->bind_param("s", $email);

  //Execute the SQL statement
  $checkStmt->execute();

  //Retrieve the result set from the executed statement
  $checkResult = $checkStmt->get_result();

  //Check if any rows were returned (email already exists)
  if ($checkResult->num_rows > 0) {
    //Display error message to the user
    echo "Email already exists. Please use another email or login.";

    //Close the statement
    $checkStmt->close();

    //Close the database connection
    $mysqli->close();

    //Terminate the script
    exit();
  }

  //Close the statement after the check is done
  $checkStmt->close();


  //Define the insert query
  $key = "12356abdefg";
  $password = crypt($password, $key);
  $query =  "INSERT INTO customer (first_name, last_name, email, phone_number, address, password) 
          VALUES (?, ?, ?, ?, ?, ?)";


  //Run the query
  try {
    $stmt = $mysqli->prepare($query);

    //Bind the parameters
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone_number, $address, $password);

    //Execute the query
    $stmt->execute();

    //Close the connection
    $stmt->close();
    echo "<p> <a href=login.html>Click Here to Login to the Member Page </a> </b></p>";
    $message = "Thank you for registering with us\nYour Details are: \nFirst Name:
		$first_name \nLast Name: $last_name \nEmail: $email\nPhone: $phone_number";

    //Send an email to the user using mail() function
    //@mail($email, "Website Registration", $message);
    echo $message . "<br>";
    echo "Please check your mail for registration confirmation";
  } catch (Exception $e) {

    //Display an error message and exit
    exit("Error inserting to the database");
  }
}
