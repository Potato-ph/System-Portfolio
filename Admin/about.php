<?php include '../connection.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | About</title>
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/Icon.png" />
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
// Fetch data from the database
$sql = "SELECT * FROM home_section WHERE id = 1"; // Assuming you want to fetch data for user with ID 1
$result = $conn->query($sql);

// Check if the query was successful and if it returned any rows
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Fetch the first row
} else {
    // Handle error or display a message if no data found
    echo "No data found.";
}
?>

   
  <div class="main-panel">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-primary">Introduction</h2>
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td id="name"><?php echo $row['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td id="role"><?php echo $row['role']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td id="desc"><?php echo $row['desc']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Profile Picture</th>
                                        <td><img src="uploads/<?php echo $row['image_path']; ?>" alt="Profile Picture" id="profile-pic"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-dark float-right mt-5" onclick="showEditForm1()">Edit</button>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-md-6 mb-5" id="editForm" style="display: none;">
                  <div class="card">
                      <div class="card-body">
                          <h2 class="card-title">Edit Details | Introduction</h2>
                          <hr>
                          <form action="action/update_profile.php" method="post" enctype="multipart/form-data">
                              <label for="name">Name:</label>
                              <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
                              
                              <label for="role">Role:</label>
                              <input type="text" id="role" name="role" value="<?php echo $row['role']; ?>">
                              
                              <label for="desc">Description:</label>
                              <textarea id="desc" name="desc" rows="6"><?php echo $row['desc']; ?></textarea>
                              
                              <label for="profile-pic">Upload Profile Picture:</label>
                              <input type="file" id="profile-pic" name="profile-pic">
                              
                              <div class="row">
                                  <div class="col">
                                      <button type="submit" class="btn btn-success btn-block mt-4">Save</button>
                                  </div>
                                  <div class="col">
                                      <button type="button" class="btn btn-danger btn-block mt-4" onclick="hideEditForm1()">Cancel</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>

                <hr>
            </div>

            <!--i want to stop the fetching data of the home_section here and use another table called about_section-->

            
            <?php
            // Fetch data from the about_section table
            $sql = "SELECT * FROM about_section WHERE id = 1"; // Assuming you want to fetch data for a specific ID
            $result = $conn->query($sql);

            // Check if the query was successful and if it returned any rows
            if ($result && $result->num_rows > 0) {
                $about_row = $result->fetch_assoc(); // Fetch the first row
            } else {
                // Handle error or display a message if no data found
                echo "No data found.";
            }
            ?>

            <!-- Display data from the about_section table -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-primary">About</h2>
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <th>Topic</th>
                                        <td id="topic"><?php echo $about_row['topic']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td id="description"><?php echo $about_row['description']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-dark float-right mt-5" onclick="showEditForm2()">Edit</button>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="col-md-6 mb-5" id="editForm2" style="display: none;">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Edit Details | About</h2>
                            <hr>
                            <form action="action/update_about.php" method="post" enctype="multipart/form-data">
                                <label for="topic">Topic:</label>
                                <input type="text" id="topic" name="topic" value="<?php echo $about_row['topic']; ?>">
                                
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" rows="6"><?php echo $about_row['description']; ?></textarea>

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-success btn-block mt-4">Save</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-block mt-4" onclick="hideEditForm2()">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php
// Fetch data from the about_section table
$sql = "SELECT * FROM about_section WHERE id = 1"; // Assuming you want to fetch data for the record with ID 1
$result = $conn->query($sql);

// Check if the query was successful and if it returned any rows
if ($result && $result->num_rows > 0) {
    $about_row = $result->fetch_assoc(); // Fetch the first row
} else {
    // Handle error or display a message if no data found
    echo "No data found in the about_section table.";
}
?>

<!-- Display skills section -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-primary">Skills</h2>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="col-6">Skill</th>
                                <th class="col-6">Percentage</th>
                            </tr>
                            <tr>
                                <td class="col-6" id="skill">Designing</td>
                                <td class="col-6" id="percentage"><?php echo $about_row['web_design_progress']; ?>%</td>
                            </tr>
                            <tr>
                                <td class="col-6" id="skill">UX/UI</td>
                                <td class="col-6" id="percentage"><?php echo $about_row['ux_ui_progress']; ?>%</td>
                            </tr>
                            <tr>
                                <td class="col-6" id="skill">Branding</td>
                                <td class="col-6" id="percentage"><?php echo $about_row['branding_progress']; ?>%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-dark float-right mt-5" onclick="showEditForm3()">Edit</button>
            </div>
        </div>
        <br>
    </div>

    <!-- Edit form for skills -->
    <div class="col-md-6 mb-5" id="editForm3" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Skills</h2>
                <hr>
                <form action="action/update_skills.php" method="post">
                    <div class="form-group">
                        <label for="designing">Designing Percentage:</label>
                        <input type="number" class="form-control" id="designing" name="designing" value="<?php echo $about_row['web_design_progress']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ux_ui">UX/UI Percentage:</label>
                        <input type="number" class="form-control" id="ux_ui" name="ux_ui" value="<?php echo $about_row['ux_ui_progress']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="branding">Branding Percentage:</label>
                        <input type="number" class="form-control" id="branding" name="branding" value="<?php echo $about_row['branding_progress']; ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block mt-4">Save</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger btn-block mt-4" onclick="hideEditForm3()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


          </div>
        </div>
      </div>

  </div>

  <script>
    function showEditForm1() {
        document.getElementById("editForm").style.display = "block";
    }

    function hideEditForm1() {
        document.getElementById("editForm").style.display = "none";
    }

    function showEditForm2() {
        document.getElementById("editForm2").style.display = "block";
    }

    function hideEditForm2() {
        document.getElementById("editForm2").style.display = "none";
    }

    function showEditForm3() {
        document.getElementById("editForm3").style.display = "block";
    }

    function hideEditForm3() {
        document.getElementById("editForm3").style.display = "none";
    }
</script> 
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

