<?php
include 'connection.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        ?>
        <script>
            // Display an alert message using JavaScript
            alert("Message sent successfully!");
            // Redirect the user to the index page after 1 second
            setTimeout(function() {
                window.location.href = "index.php";
            }, 1000);
        </script>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
