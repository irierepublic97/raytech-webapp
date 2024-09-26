<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$userName = $_SESSION['user_name'] ?? 'User';
$userRole = $_SESSION['user_role'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raytech | Profile</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/style2.css">
</head>

<body>

    <div class="sidebar" id="btn">
        <div class="top">
            <a href="index.php">
                <div class="logo">
                    <i class="bx bxl-codepen"></i>
                    <span class="bold"> Raytech</span>
                </div>
            </a>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <div class="user">
            <a href="user_profile.php">
                <img src="../assets/images/user_profile_default.jpg" alt="User Image" class="user-img">
                <div class="raymond">
                    <p class="bold"><?php echo htmlspecialchars($userName); ?></p>
                    <p><?php echo htmlspecialchars($userRole); ?></p>
            </a>
        </div>
    </div>
    <ul>
        <li>
            <a href="index.php">
                <i class="bx bxs-home"></i>
                <span class="nav-item">Home</span>
            </a>
            <span class="tooltip">Home</span>
        </li>
        <li>
            <a href="user_profile.php">
                <i class="bx bxs-user"></i>
                <span class="nav-item">Profile</span>
            </a>
            <span class="tooltip">Profile</span>
        </li>
        <li>
            <a href="../actions/booking.php">
                <i class="bx bxs-archive"></i>
                <span class="nav-item">Book Order</span>
            </a>
            <span class="tooltip">Orders</span>
        </li>
        <li>
            <a href="services.php">
                <i class="bx bxs-notepad"></i>
                <span class="nav-item">Services</span>
            </a>
            <span class="tooltip">Services</span>
        </li>
        <li>
            <a href="contact.php">
                <i class="bx bxs-phone-call"></i>
                <span class="nav-item">Contact</span>
            </a>
            <span class="tooltip">Contact</span>
        </li>
        <li>
            <a href="about.php">
                <i class="bx bx-body"></i>
                <span class="nav-item">About</span>
            </a>
            <span class="tooltip">About</span>
        </li>
        <li>
            <a href="../actions/logout.php">
                <i class="bx bx-log-out"></i>
                <span class="nav-item">Logout</span>
            </a>
            <span class="tooltip">Logout</span>
        </li>
    </ul>
    </div>

    <div class="main-content">
        <div class="container">
            <center>
                <h1>PROFILE PAGE UNDER CONSTRUCTION</h1>
                <br>
                <img src="../assets/images/maintenance.jpg.png" alt="Under Construction">
            </center>
        </div>
    </div>

</body>

<script>
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');

    btn.addEventListener('mouseover', () => {
        sidebar.classList.toggle('active');
    });

    btn.addEventListener('mouseout', () => {
        btn.style.backgroundColor = '';
        sidebar.classList.remove('active');
    });
</script>

</html>