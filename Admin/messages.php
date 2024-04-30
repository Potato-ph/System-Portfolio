<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | Messages</title>
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/Icon.png" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/message.css">
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

// Fetch messages from the database
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);
?>

<div class="main-panel">
    <div class="container bg-white p-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-primary">Messages from Clients</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if there are any messages
                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['message'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No messages found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
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
  </div>

  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <script src="js/jquery.cookie.js" type="text/javascript"></script>

</body>

</html>

