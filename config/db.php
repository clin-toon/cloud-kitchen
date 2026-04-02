<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "cloud_kitchen";

// Create the database connection 
$conn = new mysqli($host, $username, $password, $database);

// Code to check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

