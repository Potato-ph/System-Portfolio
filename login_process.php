<?php
session_start();

include 'connection.php'; // Include database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve user data by username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows == 1) {
        // Fetch the user's data
        $row = $result->fetch_assoc();
        // Verify the password
        if ($password === $row['password']) {
            // Authentication successful, set session variable and redirect to dashboard or home page
            $_SESSION['username'] = $username;
            header("Location: Admin/index.php"); // Redirect to dashboard.php or home page
            exit();
        } else {
            // Authentication failed, redirect back to login page with error message
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: login.php");
            exit();
        }
    } else {
        // No user found with the provided username, redirect back to login page with error message
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: login.php");
        exit();
    }
} else {
    // If the form is not submitted, redirect back to login page
    header("Location: login.php");
    exit();
}
?>
