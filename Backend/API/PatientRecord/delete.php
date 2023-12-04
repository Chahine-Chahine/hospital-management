<?php
include("../../connection.php");

$RecordID = $_POST['RecordID'];

$query = $mysqli->prepare('DELETE FROM PatientRecords WHERE RecordID = ?');
$query->bind_param('i', $RecordID);
$query->execute();

$response = [
    "status" => "true",
    "message" => "Patient record deleted successfully."
];

echo json_encode($response);
?>
