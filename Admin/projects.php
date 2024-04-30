<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | Projects</title>
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
              <span class="menu-title">Contact Information </span>
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

// Define variables for pagination
$results_per_page = 5; // Number of results per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
$start_index = ($current_page - 1) * $results_per_page; // Calculate the start index for fetching projects

// Retrieve project data from the database with pagination
$sql = "SELECT * FROM project_section LIMIT $start_index, $results_per_page";
$result = $conn->query($sql);
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-10 grid-margin stretch-card mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right d-flex justify-content-between">
                                    <h5 class="card-title pt-4 text-primary">My Works</h5>
                                    <button type="button" id="submit" name="submit" class="btn btn-dark" onclick="location.href='details.php';">ADD WORK</button>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>URL</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Loop through each project data and display it in the table
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td contenteditable='true'>" . $row['title'] . "</td>";
                                                echo "<td contenteditable='true'>" . $row['description'] . "</td>";
                                                echo "<td contenteditable='true'>" . $row['url'] . "</td>";
                                                echo "<td class='imagepreview'>";
                                                echo "<label for='file_" . $row['id'] . "' style='cursor: pointer;'>";
                                                echo "<img id='preview_" . $row['id'] . "' src='uploads/" . $row['image_path'] . "' width='100'>";
                                                echo "</label>";
                                                echo "<input type='file' id='file_" . $row['id'] . "' style='display: none;' accept='image/*' onchange='previewImage(this)'>";
                                                echo "</td>";
                                                echo "<td class='action-buttons'>
                                                          <button class='btn btn-success mb-3 w-100' onclick='saveEdit(this)'>Save</button>
                                                          <button class='btn btn-danger w-100' onclick='deleteProject(" . $row['id'] . ")'>Delete</button>
                                                        </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No projects found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            // Display pagination links if needed
                            $sql = "SELECT COUNT(id) AS total FROM project_section";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $total_pages = ceil($row['total'] / $results_per_page);
                            ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-3">
                                    <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo ($current_page - 1); ?>" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                        <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?php echo ($current_page == $total_pages) ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo ($current_page + 1); ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // JavaScript function to handle image preview
    function previewImage(input) {
        var id = input.id.split("_")[1];
        var preview = document.getElementById('preview_' + id);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // JavaScript function to confirm deletion of project
    function deleteProject(id) {
        if (confirm("Are you sure you want to delete this project?")) {
            // Redirect to delete_project.php with project ID
            window.location.href = "action/delete_project.php?id=" + id;
        }
    }

    // JavaScript function to save edited content
    function saveEdit(btn) {
        var row = btn.closest('tr');
        var id = row.cells[0].innerText;
        var title = row.cells[1].innerText;
        var description = row.cells[2].innerText;
        var url = row.cells[3].innerText;
        var image = document.getElementById('file_' + id).files[0]; // Get selected image file

        var formData = new FormData();
        formData.append('id', id);
        formData.append('title', title);
        formData.append('description', description);
        formData.append('url', url);
        formData.append('image', image); // Append selected image file to form data

        // AJAX request to edit_project.php
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle response from edit_project.php
                var response = xhr.responseText;
                if (response.trim() == 'success') {
                    // Optionally show a success message or perform any other action
                    alert('Project updated successfully!');
                } else {
                    // Optionally show an error message or perform any other action
                    alert('Error updating project. Please try again later.');
                }
            }
        };
        xhr.open("POST", "action/edit_project.php", true);
        xhr.send(formData); // Send form data including image file
    }
</script>



          
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

