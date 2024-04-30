<?php // Include the database connection
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light fixed-top">
        <div class="container">
            <div class="logo">
                <a href="login.php"><lord-icon 
                    src="https://cdn.lordicon.com/yhwigecd.json"
                    trigger="loop"
                    stroke="light"
                    colors="primary:#121331,secondary:#5c0e0a"
                    style="width:50px;height:50px">
                </lord-icon></a>
                <a class="navbar-brand" href="login.php">SKF</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="#home" class="nav-link"><span data-hover="Home">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link"><span data-hover="About">About</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#project" class="nav-link"><span data-hover="Projects">Projects</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link"><span data-hover="Contact">Contact</span></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>  

    <?php

// Query to fetch data from the home_section table
$sql = "SELECT * FROM home_section";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $image_path = "Admin/uploads/" . $row['image_path'];
        ?>
        <section class="home-section" id="home">
            <div class="container col-lg-10">  
                <div class="row mt-5">
                    <div class="col-lg-7 col-md-12 col-12 d-flex m-auto">
                        <div class="about-text">
                            <small class="small-text">Welcome to <span class="mobile-block">my portfolio website!</span></small>
                            <h1 class="animated animated-text pt-3">
                                <p>Hey folks,</p>
                                <span style="font-size: 62px;">I'm</span>
                                    <div class="animated-info">
                                        <span class="animated-item"><?php echo $row['name']; ?></span>
                                        <span class="animated-item"><?php echo $row['role']; ?></span>
                                    </div>
                            </h1>
                            <small><?php echo $row['desc']; ?></small>
                            <div class="buttons">
                                <!-- Add dynamic links here if needed -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-10 col-10">
                        <div class="home-image">
                        <img src="<?php echo $image_path; ?>" class="img-fluid" alt="Home Image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
} else {
    echo "No data found";
}
?>

    
<?php

// Query to fetch data from the about_section table
$sql = "SELECT * FROM about_section";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
        <section class="about-section" id="about">
            <div class="container-fluid col-lg-10 px-5 mb-3">
                <div class="row" style="align-items: center ">
                    <lord-icon
                        src="https://cdn.lordicon.com/jmswjgpv.json"
                        trigger="loop"
                        delay="2000"
                        colors="primary:#f4a09c"
                        style="width:400px;height:400px">
                    </lord-icon>
                    <div class="my-auto col-lg-7 col-md-12 col-12 d-flex align-items-center">
                        <div class="about-details">
                            <div class="right">
                                <div class="topic"><?php echo $row['topic']; ?></div>
                                <hr>
                                <p class="about-info"><?php echo $row['description']; ?></p>
                                <!-- Progress Bars for Skills -->
                                <div class="skills">
                                    <div class="skill">
                                        <div class="skill-name my-2">Web Design</div>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: <?php echo $row['web_design_progress']; ?>%;"><?php echo $row['web_design_progress']; ?>%</div>
                                        </div>
                                    </div>
                                    <div class="skill">
                                        <div class="skill-name my-2">UX/UI</div>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: <?php echo $row['ux_ui_progress']; ?>%;"><?php echo $row['ux_ui_progress']; ?>%</div>
                                        </div>
                                    </div>
                                    <div class="skill">
                                        <div class="skill-name my-2">Branding</div>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: <?php echo $row['branding_progress']; ?>%;"><?php echo $row['branding_progress']; ?>%</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Progress Bars -->
                                <div class="button">
                                    <a href="Fernnado-CV.pdf" download>
                                        <button class="dlbtn mt-3">Download CV</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
} else {
    echo "No data found";
}

?>

    
<section class="project-section" id="project">
    <div class="main">
        <div class="row col-lg-12">
            <div class="col-10">
                <h3 class="mb-3">My Works</h3>
            </div>
            <div class="col-2">
                <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <hr>
            
            <div class="col-12">
                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
<?php
// Fetch project data from the database
$sql = "SELECT * FROM project_section";
$result = mysqli_query($conn, $sql);
$active = true; // Flag to mark the first carousel item as active

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    $counter = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($counter % 3 == 0) {
            // Start a new carousel item
            echo '<div class="carousel-item ' . ($active ? 'active' : '') . '"><div class="row">';
            $active = false; // Set the flag to false after the first item
        }
        ?>
        <div class="col-md-4 mb-3 d-flex align-items-stretch mb-3">
            <div class="card h-100">
                <img class="card-img-top" alt="100%x280" src="Admin/uploads/<?php echo $row['image_path']; ?>">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title"><?php echo $row['title']; ?></h4>
                    <p class="card-text flex-grow-1"><?php echo $row['description']; ?></p>
                    <!-- Modify this button to a link -->
                    <a href="<?php echo $row['url']; ?>" class="btn btn-dark">Visit Website</a>
                </div>
            </div>
        </div>
        <?php
        $counter++;
        if ($counter % 3 == 0) {
            // Close the current carousel item
            echo '</div></div>';
        }
    }
    // Close the last carousel item if the total number of projects is not a multiple of 3
    if ($counter % 3 != 0) {
        echo '</div></div>';
    }
} else {
    // Display a message if no projects are found
    echo "No projects found.";
}
?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    
<?php
$sql = "SELECT * FROM contact_information";
$result = $conn->query($sql);

// Check if there is at least one row in the result
if ($result && $result->num_rows > 0) {
    // Fetch the first row
    $row = $result->fetch_assoc();
} else {
}
?>

<section class="contact-section my-5" id="contact">
    <div class="container container-contact col-lg-12 col-md-9 col-12 d-flex m-auto">
        <div class="content">
            <div class="left-side">
                <div class="address details">
                    <lord-icon
                        src="https://cdn.lordicon.com/iikoxwld.json"
                        trigger="loop"
                        delay="2000"
                        colors="primary:#5c0e0a"
                        style="width:30px;height:30px">
                    </lord-icon>
                    <div class="topic">Address</div>
                    <div class="text-one"><?php echo $row['address']; ?></div>
                </div>
                <div class="phone details">
                    <lord-icon
                        src="https://cdn.lordicon.com/srsgifqc.json"
                        trigger="loop"
                        state="morph-phone-hang-up"
                        colors="primary:#5c0e0a"
                        style="width:25px;height:25px">
                    </lord-icon>
                    <div class="topic">Phone</div>
                    <div class="text-one"><?php echo $row['phone']; ?></div>
                </div>
                <div class="email details">
                    <lord-icon
                        src="https://cdn.lordicon.com/xtzvywzp.json"
                        trigger="loop"
                        delay="500"
                        state="in-email"
                        colors="primary:#5c0e0a"
                        style="width:25px;height:25px">
                    </lord-icon>
                    <div class="topic">Email</div>
                    <div class="text-one"><?php echo $row['email']; ?></div>
                </div>
            </div>
            <div class="right-side">
                <div class="topic-text">Send a message</div>
                <p class="pt-3">If you have any work from me, you can send me a message from here. It's my pleasure to help you.</p>
                <form action="send_message.php" method="post">
                    <div class="input-box">
                        <input type="text" name="name" placeholder="Enter your name">
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="input-box message-box">
                        <textarea name="message" id="" cols="30" rows="10" placeholder="Input your message here..."></textarea>
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" value="Send Now">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



    <footer>
        <div class="text">
            <span> &copy; Sheena Fernando | 2024 All Rights Reserved</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>