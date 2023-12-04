<?php
include("../../connection.php");

$RecordID = $_POST['RecordID'];
$Diagnosis = $_POST['Diagnosis'];
$Treatment = $_POST['Treatment'];
$Prescription = $_POST['Prescription'];
$RecordDateTime = $_POST['RecordDateTime'];

$query = $mysqli->prepare('UPDATE PatientRecords SET Diagnosis = ?, Treatment = ?, Prescription = ?, RecordDateTime = ? WHERE RecordID = ?');
$query->bind_param('ssssi', $Diagnosis, $Treatment, $Prescription, $RecordDateTime, $RecordID);
$query->execute();

$response = [
    "status" => "true",
    "message" => "Patient record updated successfully."
];

echo json_encode($response);
?>
