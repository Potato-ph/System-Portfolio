<?php
// Database credentials
$servername = "sql108.infinityfree.com"; // Change this to your database server
$username = "if0_36436326"; // Change this to your database username
$password = "FEJnI3zT2LM"; // Change this to your database password
$dbname = "if0_36436326_skf"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}