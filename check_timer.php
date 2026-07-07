<?php
header('Content-Type: application/json');

// Set the timezone to India
date_default_timezone_set('Asia/Kolkata');

// Set the target end time (example: May 29, 2024, 16:00:00)
$endTime = strtotime("2024-06-22 00:00:00");
$currentTime = time();
$remainingTime = $endTime - $currentTime;

if ($remainingTime <= 0) {
    echo json_encode(['enabled' => true, 'remainingTime' => 0]);
} else {
    echo json_encode(['enabled' => false, 'remainingTime' => $remainingTime]);
}
?>
