<?php
// Include database connection file
include '../../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve project ID from the GET parameters
    $id = $_GET['id'];

    // Delete project from the database
    $sql = "DELETE FROM project_section WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page displaying the projects
        header("Location: ../index.php");
        exit();
    } else {
        // Handle the error if deletion fails
        echo "Error: " . $conn->error;
    }
} else {
    // Handle the case if no ID is provided
    echo "Error: No project ID provided";
}
?>
