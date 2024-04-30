<?php
// Include database connection file
include '../../connection.php';

// Fetch user ID (assuming you have already implemented user authentication)
$user_id = 1;

// Retrieve updated values from the AJAX request
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

// Check if new password matches the confirmation password
if ($newPassword !== $confirmPassword) {
    echo "New password and confirmation password don't match";
    exit(); // Exit the script if passwords don't match
}

// Fetch current password from the database for comparison
$sql = "SELECT password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "User not found";
    exit(); // Exit the script if user not found
}

$hashedPassword = $row['password'];

// Verify if the provided current password matches the one stored in the database
if (!password_verify($currentPassword, $hashedPassword)) {
    echo "Incorrect current password";
    exit(); // Exit the script if current password is incorrect
}

// Update the password in the database
$newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$updateSql = "UPDATE users SET password = ? WHERE id = ?";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bind_param("si", $newHashedPassword, $user_id);

if ($updateStmt->execute()) {
    echo "Password updated successfully";
} else {
    echo "Error updating password: " . $conn->error;
}

// Close the prepared statements and database connection
$stmt->close();
$updateStmt->close();
$conn->close();
?>
