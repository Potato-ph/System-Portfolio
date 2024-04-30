<?php
// Include the database connection file
include '../../connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $designing = $_POST['designing'];
    $ux_ui = $_POST['ux_ui'];
    $branding = $_POST['branding'];

    // Update the about_section table with the new skills percentages
    $sql = "UPDATE about_section SET web_design_progress=?, ux_ui_progress=?, branding_progress=? WHERE id=1"; // Assuming the skills data is for record with ID 1
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $designing, $ux_ui, $branding);

    if ($stmt->execute()) {
        // Redirect back to the page with a success message
        header("Location: ../index.php?success=1");
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
