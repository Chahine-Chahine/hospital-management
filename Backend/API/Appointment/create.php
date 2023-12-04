<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$PatientID = $_POST['PatientID'];
$DoctorID = $_POST['DoctorID'];
$AppointmentDateTime = $_POST['AppointmentDateTime'];
$Status = $_POST['Status'];


$query = $mysqli->prepare('insert into appointment(PatientID, DoctorID, AppointmentDateTime, Status) 
values(?,?,?,?)');
$query->bind_param('iiss',$PatientID, $DoctorID , $AppointmentDateTime, $Status);
$query->execute();

$response = [];
$response["status"] = "true";

echo json_encode($response);
