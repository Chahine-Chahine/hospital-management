<?php
include("../../connection.php");

$AssignmentID = $_POST['AssignmentID']; 

$query = $mysqli->prepare('SELECT RoomAssignment.*, Patient.*, Room.Status
                           FROM RoomAssignment
                           JOIN Patient ON RoomAssignment.PatientID = Patient.PatientID
                           JOIN Room ON RoomAssignment.RoomID = Room.RoomID
                           WHERE RoomAssignment.AssignmentID = ?');
$query->bind_param('i', $AssignmentID);
$query->execute();

$result = $query->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    $response = [
        "status" => "false",
        "message" => "Room assignment not found."
    ];
    echo json_encode($response);
}

?>
