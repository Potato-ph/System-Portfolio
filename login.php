<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<title>Login</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: 
        radial-gradient(circle at left bottom, rgba(134, 112, 112, 0.1), rgba(134, 112, 112, 0.1) 99.5%, rgba(0, 0, 0, 0) 100%) 2% 97%,
        radial-gradient(circle at left bottom, rgba(255, 255, 255, 0.1), rgba(86, 28, 36, 0.1) 99.5%, rgba(0, 0, 0, 0) 100%) -1% 50%,
        radial-gradient(circle at left top, rgba(255, 255, 255, 0.1), rgba(86, 28, 36, 0.1) 99.5%, rgba(0, 0, 0, 0) 100%) 0 92%,
        radial-gradient(circle at left top, rgba(134, 112, 112, 0.1), rgba(86, 28, 36, 0.1) 99.5%, rgba(0, 0, 0, 0) 100%) 100% 50%,
        linear-gradient(rgba(134, 112, 112, 0.1), rgba(255, 255, 255, 0.1)) 50% 0;
        background-size: calc(4*100px) calc(1.5*100px + 37.5px);

    }
    .login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 0px  40px 0px 40px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 25%;
}

.login-container h2 {
    text-align: center;
    /* margin-bottom: 20px; */

}

.login-container input[type="text"],
.login-container input[type="password"],
.login-container input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
    align-self: center;
}

.login-container input[type="submit"] {
    background-color: #D5B4B4;
    color: #fff;
    cursor: pointer;
    transition: 0.4s;
}

.login-container input[type="submit"]:hover {
    background-color: #867070;
}

</style>
</head>
<body>

<div class="login-container">
    <lord-icon
        src="https://cdn.lordicon.com/pyarizrk.json"
        trigger="loop"
        delay="1000"
        stroke="light"
        colors="primary:#121331,secondary:#faddd1,tertiary:#fad3d1,quaternary:#4d2c19"
        style="width:150px;height:150px">
    </lord-icon>
    <h2>Login</h2>
    <?php
    // Display error message if it exists in session
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Clear the error message from session
    }
    ?>
    <form action="login_process.php" method="post">
        <div class="mx-2">
            <div style="position: relative;">
                <i class="bi bi-person" style="position: absolute; top:40%; transform: translateY(-55%); left: 11px;"></i>
                <input type="text" name="username" placeholder="Username" required style="padding-left: 30px;">
            </div>
            <div style="position: relative;">
                <i class="bi bi-shield-lock" style="position: absolute; top:40%; transform: translateY(-55%); left: 11px;"></i>
                <input type="password" name="password" placeholder="Password" required style="padding-left: 31px;">
            </div>
            <input type="submit" value="Login">
        </div>
    </form>
</div>
<script src="https://cdn.lordicon.com/lordicon.js"></script>

</body>
</html>
