<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$RoomID = $_POST['RoomID'];
$STATUS = $_POST['STATUS'];

// Check if the room already exists
$checkQuery = $mysqli->prepare('SELECT RoomID FROM rooms WHERE RoomID = ?');
$checkQuery->bind_param('i', $RoomID);
$checkQuery->execute();
$checkResult = $checkQuery->get_result();

if ($checkResult->num_rows > 0) {
    // Room already exists, show a message
    $response = [
        "status" => "false",
        "message" => "Room already occupied."
    ];
} else {
    // Room doesn't exist, proceed with insertion
    $insertQuery = $mysqli->prepare('INSERT INTO rooms (RoomID, STATUS) VALUES (?, ?)');
    $insertQuery->bind_param('is', $RoomID, $STATUS);
    $insertQuery->execute();

    $response = [
        "status" => "true",
        "message" => "Room added successfully."
    ];
}

echo json_encode($response);
?>
