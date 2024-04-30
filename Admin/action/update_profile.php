<?php
// Include database connection
include "../../connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $role = $_POST['role'];
    $desc = $_POST['desc'];

    // Check if a file is uploaded
    if ($_FILES['profile-pic']['name']) {
        // File upload configuration
        $targetDir = "../uploads/";
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');

        // Get file details
        $fileName = basename($_FILES['profile-pic']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if file type is allowed
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetFilePath)) {
                // Update profile details in the database including the image path
                $imagePath = "../uploads/" . $fileName;
                $sql = "UPDATE home_section SET name=?, role=?, `desc`=?, image_path=? WHERE id = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $name, $role, $desc, $imagePath);

                // Execute the statement
                if ($stmt->execute()) {
                    // Display alert
                    echo "<script>alert('Profile updated successfully!');</script>";
                    // Redirect back to the page with success message after the alert
                    echo "<script>window.location.href='../about.php?message=success';</script>";
                    exit();
                } else {
                    // Display SQL error
                    echo "Error updating profile: " . $stmt->error;
                }
            } else {
                // Display file upload error
                echo "Error uploading file: " . $_FILES['profile-pic']['error'];
            }
        } else {
            // Display invalid file type error
            echo "Invalid file type.";
        }
    } else {
        // If no file is uploaded, update profile details excluding the image path
        $sql = "UPDATE home_section SET name=?, role=?, `desc`=? WHERE id = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $role, $desc);

        // Execute the statement
        if ($stmt->execute()) {
            // Display alert
            echo "<script>alert('Profile updated successfully!');</script>";
            // Redirect back to the page with success message after the alert
            echo "<script>window.location.href='../about.php?message=success';</script>";
            exit();
        } else {
            // Display SQL error
            echo "Error updating profile: " . $stmt->error;
        }
    }
} else {
    // If the form is not submitted, redirect back to the page
    header("Location: ../about.php");
    exit();
}
?>
