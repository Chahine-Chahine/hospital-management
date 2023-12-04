<?php
include("../../connection.php");

$AssignmentID = $_POST['AssignmentID']; 

$query = $mysqli->prepare('SELECT RoomAssignment.*, Patients.*, Rooms.Status
                           FROM RoomAssignment
                           JOIN Patients ON RoomAssignment.PatientID = Patients.PatientID
                           JOIN Rooms ON RoomAssignment.RoomID = Rooms.RoomID
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
