<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | My Account</title>
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/Icon.png" />
  <link rel="stylesheet" href="css/myaccount.css">
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row ">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
         
          <button class="navbar-toggler navbar-toggler" type="button" data-toggle="minimize">   
          <lord-icon
                src="https://cdn.lordicon.com/yhwigecd.json"
                trigger="hover"
                stroke="light"
                colors="primary:#121331,secondary:#911710"
                style="width:30px;height:30px"> 
            </lord-icon>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end"> 
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">
              <i class="mdi mdi-pen menu-icon"></i>
              <span class="menu-title">About</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="projects.php">
              <i class="mdi mdi-file-compare menu-icon"></i>
              <span class="menu-title">Projects</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">
              <i class="mdi mdi-message-text menu-icon"></i>
              <span class="menu-title">Messages</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myaccount.php">
              <i class="mdi mdi-account-card-details menu-icon"></i>
              <span class="menu-title">Contact Information</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="logoutBtn">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Log Out</span>
            </a>
        </li>
        </ul>
      </nav>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>
    // Get the logout button element
    var logoutBtn = document.getElementById("logoutBtn");

    // Add click event listener to the logout button
    logoutBtn.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link behavior

        // Display SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log me out!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform logout operation (e.g., clear session or perform AJAX request)
                // After logout operation, redirect to index.php
                window.location.href = "../index.php";
            }
        });
    });
</script>

<?php
// Include database connection file
include '../connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address']; // Changed from 'location'
    
    // Update contact information in the database
    $sql = "UPDATE contact_information SET email='$email', phone='$phone', address='$address'"; // Changed from 'location'
    
    if ($conn->query($sql) === TRUE) {
        echo "Contact information updated successfully";
    } else {
        echo "Error updating contact information: " . $conn->error;
    }
}

// Fetch contact information from the contact_information table
$sql = "SELECT * FROM contact_information";
$result = $conn->query($sql);

// Check if contact information is fetched successfully
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address']; // Changed from 'location'
} else {
    echo "Error: Contact information not found";
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="container">
                <div class="row gutters" id="update">
                    <div class="col-xl-8 mx-auto">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-4 text-primary"><Strong>UPDATE | CONTACT INFORMATION</Strong></h6>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-xl-11">
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                <div class="form-group">
                                                    <label for="eMail">Email</label>
                                                    <input type="email" class="form-control" id="eMail" name="email" placeholder="Enter Email" value="<?php echo $email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Number" value="<?php echo $phone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label> <!-- Changed from 'Location' -->
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo $address; ?>"> <!-- Changed from 'Location' -->
                                                </div>
                                                <div class="text-right d-flex justify-content-end">
                                                    <button type="submit" name="submit" class="btn btn-success me-3">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>         
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
</div>


    </div>
  </div>

  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <script src="js/template.js"></script>
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
 
</body>
</html>

