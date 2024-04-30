<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ADMIN | SKF </title>
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="css/style.css">
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

// Fetch total message count
$sqlTotalMessages = "SELECT COUNT(id) AS total_messages FROM messages";
$resultTotalMessages = $conn->query($sqlTotalMessages);
$totalMessages = 0;

if ($resultTotalMessages->num_rows > 0) {
    $rowTotalMessages = $resultTotalMessages->fetch_assoc();
    $totalMessages = $rowTotalMessages['total_messages'];
}

// Fetch total works posted count
$sqlTotalWorksPosted = "SELECT COUNT(id) AS total_works FROM project_section";
$resultTotalWorksPosted = $conn->query($sqlTotalWorksPosted);
$totalWorksPosted = 0;

if ($resultTotalWorksPosted->num_rows > 0) {
    $rowTotalWorksPosted = $resultTotalWorksPosted->fetch_assoc();
    $totalWorksPosted = $rowTotalWorksPosted['total_works'];
}

// Fetch messages received per week data
$sqlMessagesPerWeek = "SELECT WEEK(created_at) AS week_number, COUNT(id) AS message_count 
                      FROM messages 
                      GROUP BY WEEK(created_at)";
$resultMessagesPerWeek = $conn->query($sqlMessagesPerWeek);
$weeks = [];
$messageCounts = [];

if ($resultMessagesPerWeek->num_rows > 0) {
    while ($row = $resultMessagesPerWeek->fetch_assoc()) {
        $weeks[] = "Week " . $row['week_number'];
        $messageCounts[] = $row['message_count'];
    }
}

// Convert PHP arrays to JavaScript arrays for Chart.js
$jsWeeks = json_encode($weeks);
$jsMessageCounts = json_encode($messageCounts);
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                        <div class="me-md-3 me-xl-5">
                            <h2 class="ml-5">&ensp;Welcome back, <strong><span>Admin</span></strong></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-black"><?php echo $totalMessages; ?></h1>
                        <hr>
                        <h5 class="card-title">TOTAL MESSAGES RECEIVED</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mx-auto grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h1><?php echo $totalWorksPosted; ?></h1> <!-- Display total works posted count -->
                        <hr>
                        <h5 class="card-title">TOTAL WORK POSTED</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 m-auto grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Messages Received per Week</h5>
                        <hr>
                        <canvas id="messagesPerWeekChart"></canvas> <!-- Placeholder for chart -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('messagesPerWeekChart').getContext('2d');
    var weeks = <?php echo $jsWeeks; ?>;
    var messageCounts = <?php echo $jsMessageCounts; ?>;

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: weeks,
            datasets: [{
                label: 'Messages Received',
                data: messageCounts,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

          
    </div>
</div>

        
         
        </div>
      </div>
    </div>
  </div>

  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>

