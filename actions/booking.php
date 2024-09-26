<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../views/login.php");
    exit();
}
$userName = $_SESSION['user_name'] ?? 'User';
$userRole = $_SESSION['user_role'] ?? 'User';

require_once "../classes/database.php";


$successMessage = '';
$errorMessage = '';

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingDate = $_POST['date'];
    $bookingTime = $_POST['time'];
    $service = $_POST['service'];
    $userId = $_SESSION['user_id'];


    $sql = "INSERT INTO bookings (user_id, booking_date, booking_time, service) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "isss", $userId, $bookingDate, $bookingTime, $service);
        mysqli_stmt_execute($stmt);
        $successMessage = "Booking successful!";
    } else {
        $errorMessage = "Error in booking. Please try again.";
    }
}


$name = $_SESSION['user_name'] ?? '';
$email = $_SESSION['user_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raytech | Booking</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/style2.css">
    <link rel="stylesheet" href="../assets/booking.css">
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
                <img src="../assets/images/user_profile_default.jpg" alt="background" class="user-img">
                <div class="raymond">
                    <p class="bold"><?php echo htmlspecialchars($name); ?></p>
                    <p><?php echo htmlspecialchars($userRole); ?></p>
            </a>
        </div>
    </div>
    <ul>
        <li><a href="../views/index.php"><i class="bx bxs-home"></i><span class="nav-item">Home</span></a></li>
        <li><a href="../views/user_profile.php"><i class="bx bxs-user"></i><span class="nav-item">Profile</span></a>
        </li>
        <li><a href="../views/booking.php"><i class="bx bxs-archive"></i><span class="nav-item">Book Order</span></a>
        </li>
        <li><a href="../views/services.php"><i class="bx bxs-notepad"></i><span class="nav-item">Services</span></a>
        </li>
        <li><a href="../views/contact.php"><i class="bx bxs-phone-call"></i><span class="nav-item">Contact</span></a>
        </li>
        <li><a href="../views/about.php"><i class="bx bx-body"></i><span class="nav-item">About</span></a></li>
        <li><a href="../actions/logout.php"><i class="bx bx-log-out"></i><span class="nav-item">Logout</span></a></li>
    </ul>
    </div>

    <div class="main-content">
        <div class="container">
            <h1>Booking Form</h1>
            <?php if ($successMessage): ?>
                <p class="success"><?php echo htmlspecialchars($successMessage); ?></p>
            <?php elseif ($errorMessage): ?>
                <p class="error"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>
            <br>
            <form action="booking.php" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="date">Booking Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Booking Time</label>
                    <input type="time" id="time" name="time" required>
                </div>
                <div class="form-group">
                    <label for="service">Select Service</label>
                    <select id="service" name="service" required>
                        <option value="">Choose...</option>
                        <option value="service1">Service 1</option>
                        <option value="service2">Service 2</option>
                        <option value="service3">Service 3</option>
                    </select>
                </div>
                <div class="form-btn">
                    <input type="submit" value="Book Now" name="book" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').setAttribute('min', today);
        });


        document.getElementById('date').addEventListener('change', function () {
            const selectedDate = new Date(this.value);
            const now = new Date();


            const timeInput = document.getElementById('time');


            timeInput.value = '';


            const times = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];


            if (selectedDate.toDateString() === now.toDateString()) {
                const currentHour = now.getHours();
                const currentMinute = now.getMinutes();
                times.forEach(time => {
                    const [hour, minute] = time.split(':').map(Number);
                    if (hour < currentHour || (hour === currentHour && minute <= currentMinute)) {

                        timeInput.querySelector(`option[value="${time}"]`).setAttribute('disabled', 'disabled');
                    }
                });
            }
        });
    </script>

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
</body>

</html>