<?php
    // Establish a database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'login';

$mysqli = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Perform your database operations here

// Close the connection when you're done

?>
