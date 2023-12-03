<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$RoomID = $_POST['RoomID'];

// Check if the room exists before attempting deletion
$checkQuery = $mysqli->prepare('SELECT RoomID FROM room WHERE RoomID = ?');
$checkQuery->bind_param('i', $RoomID);
$checkQuery->execute();
$checkResult = $checkQuery->get_result();

if ($checkResult->num_rows > 0) {
    // Room exists, proceed with deletion
    $deleteQuery = $mysqli->prepare('DELETE FROM room WHERE RoomID = ?');
    $deleteQuery->bind_param('i', $RoomID);
    $deleteQuery->execute();

    $response = [
        "status" => "true",
        "message" => "Room deleted successfully."
    ];
} else {
    // Room doesn't exist, show a message
    $response = [
        "status" => "false",
        "message" => "Room not found."
    ];
}

echo json_encode($response);
?>
