<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login_register";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


function insertBooking($userId, $bookingDate, $bookingTime)
{
    global $conn;

    $sql = "INSERT INTO bookings (user_id, booking_date, booking_time) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "iss", $userId, $bookingDate, $bookingTime);
        mysqli_stmt_execute($stmt);
        return true;
    } else {
        return false;
    }
}


function getUserIdByEmail($email)
{
    global $conn;

    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['id'];
        }
    }

    return null;
}
