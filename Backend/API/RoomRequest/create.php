<?php
include("../../connection.php");

$PatientID = $_POST['PatientID'];
$RoomID = $_POST['RoomID'];
$AssignmentDateTime = $_POST['AssignmentDateTime'];

$query = $mysqli->prepare('INSERT INTO RoomAssignment (PatientID, RoomID, AssignmentDateTime) VALUES (?, ?, ?)');
$query->bind_param('iis', $PatientID, $RoomID, $AssignmentDateTime);
$query->execute();

$response = [
    "status" => "true",
    "message" => "Room assignment created successfully."
];

echo json_encode($response);
?>
