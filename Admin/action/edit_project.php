<?php
// Include database connection file
include '../../connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $url = $_POST['url']; // Added URL field

    // Check if an image file is uploaded
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_name_parts = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($file_name_parts));

        $upload_path = "../uploads/"; // Define upload directory
        $new_file_name = uniqid('', true) . '.' . $file_ext; // Generate unique file name
        $upload_file = $upload_path . $new_file_name; // Path for uploading file

        // Move uploaded file to specified directory
        if (move_uploaded_file($file_tmp, $upload_file)) {
            // Update project details including image path and URL in the database using prepared statements
            $sql = "UPDATE project_section SET title=?, description=?, url=?, image_path=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $title, $description, $url, $new_file_name, $id);
            if ($stmt->execute()) {
                // Return success message
                echo "success";
            } else {
                // Return error message
                echo "Error updating project: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Return error message if file upload fails
            echo "File upload failed";
        }
    } else {
        // Update project details without updating image path and URL in the database using prepared statements
        $sql = "UPDATE project_section SET title=?, description=?, url=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $description, $url, $id);
        if ($stmt->execute()) {
            // Return success message
            echo "success";
        } else {
            // Return error message
            echo "Error updating project: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
