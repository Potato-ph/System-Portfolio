<?php
// Include database connection file
include '../../connection.php';

// Fetch user ID (assuming you have already implemented user authentication)
$user_id = 1; 

// Retrieve updated values from the AJAX request
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$location = $_POST['location'];

// Update user details in the database
$sql = "UPDATE users SET username = ?, email = ?, phone = ?, location = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $username, $email, $phone, $location, $user_id); // Corrected parameter binding

if ($stmt->execute()) {
    // Return a success message
    echo "User details updated successfully";
} else {
    // Return an error message
    echo "Error updating user details: " . $conn->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
