<?php
include("../../connection.php");

$PatientID = $_POST['PatientID'];
$DoctorID = $_POST['DoctorID'];
$Diagnosis = $_POST['Diagnosis'];
$Treatment = $_POST['Treatment'];
$Prescription = $_POST['Prescription'];
$RecordDateTime = $_POST['RecordDateTime'];

$query = $mysqli->prepare('INSERT INTO PatientRecord (PatientID, DoctorID, Diagnosis, Treatment, Prescription, RecordDateTime) VALUES (?, ?, ?, ?, ?, ?)');
$query->bind_param('iissss', $PatientID, $DoctorID, $Diagnosis, $Treatment, $Prescription, $RecordDateTime);
$query->execute();

$response = [
    "status" => "true",
    "message" => "Patient record created successfully."
];

echo json_encode($response);
?>
