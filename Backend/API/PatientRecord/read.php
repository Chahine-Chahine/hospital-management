<?php
include("../../connection.php");

$RecordID = $_POST['RecordID']; // Assuming you're using GET method to pass RecordID

$query = $mysqli->prepare('SELECT * FROM PatientRecord WHERE RecordID = ?');
$query->bind_param('i', $RecordID);
$query->execute();

$result = $query->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    $response = [
        "status" => "false",
        "message" => "Patient record not found."
    ];
    echo json_encode($response);
}
?>
