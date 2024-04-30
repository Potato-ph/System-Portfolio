<?php
// Include database connection file
include '../../connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $topic = $_POST['topic'];
    $description = $_POST['description'];

    // Update the about_section table
    $sql = "UPDATE about_section SET topic=?, description=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $topic, $description);

    if ($stmt->execute()) {
        // Display success message
        echo "<h3>Update successful!</h3>";

        // Redirect back to the page after a delay
        header("refresh:2; url=../index.php");
        exit();
    } else {
        // Redirect back to the page with an error message
        header("Location: ../index.php?error=1");
        exit();
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect back to the page
    header("Location: ../index.php");
    exit();
}
?>
