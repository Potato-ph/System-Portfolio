<?php
// Include database connection file
include '../../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $url = !empty($_POST['url']) ? $_POST['url'] : null; // Allow URL to be null

    // Check if an image file is uploaded
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
        
        $extensions = array("jpeg","jpg","png");

        // Check file extension
        if (in_array($file_ext, $extensions) === false) {
            // Return error message if file extension is not allowed
            echo "extension not allowed, please choose a JPEG or PNG file.";
            exit();
        }

        // Check file size
        if ($file_size > 2097152) {
            // Return error message if file size exceeds 2MB
            echo 'File size must be less than 2 MB';
            exit();
        }
        
        $upload_path = "../uploads/"; // Define upload directory
        $new_file_name = uniqid() . '.' . $file_ext; // Generate unique file name
        $upload_file = $upload_path . $new_file_name; // Path for uploading file
        
        // Move uploaded file to specified directory
        if (move_uploaded_file($file_tmp, $upload_file)) {
            // Insert project details including image path into the database
            $sql = "INSERT INTO project_section (title, description, url, image_path) VALUES ('$title', '$description', '$url', '$upload_file')";
            if ($conn->query($sql) === TRUE) {
                // Redirect to the page where the project is listed
                header("Location: ../projects.php");
                exit();
            } else {
                // Return error message if database insertion fails
                echo "error";
            }
        } else {
            // Return error message if file upload fails
            echo "File upload failed";
        }
    } else {
        // Insert project details without inserting image path into the database
        $sql = "INSERT INTO project_section (title, description, url) VALUES ('$title', '$description', '$url')";
        if ($conn->query($sql) === TRUE) {
            // Redirect to the page where the project is listed
            header("Location: projects.php");
            exit();
        } else {
            // Return error message if database insertion fails
            echo "error";
        }
    }
}
?>
