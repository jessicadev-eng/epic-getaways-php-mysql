<?php
//Data access class/script for Epic Getaways
$server = "localhost:3307";
$user = "root";
$pass = "";
$database = "getawaysdb";

//Conect to the MySQL server/db
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try 
{
    $mysqli = new mysqli($server, $user, $pass, $database);
    // Show success message
    //echo "Database connection successful.";
} 
catch (Exception $ex) 
{
    error_log($ex->getMessage());
    exit("Error connecting to the database");
}
?>