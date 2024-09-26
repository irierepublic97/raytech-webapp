<?php
session_start();
require_once "../classes/database.php";

if (!isset($_SESSION["user"])) {
    header("Location: ../views/login.php");
    exit();
}

$sql = "SELECT booking_date AS start, booking_time AS end, service AS title FROM bookings";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $events = [];
    while ($row = mysqli_fetch_assoc($result)) {

        $start = $row['start'] . ' ' . $row['end'];
        $events[] = [
            'title' => $row['title'],
            'start' => $start,
            'end' => $row['start'] . ' ' . $row['end']
        ];
    }

    echo json_encode($events);
} else {
    echo json_encode([]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
