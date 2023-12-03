<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");


$PatientID = $_POST['PatientID'];
$UserID = $_POST['UserID'];
$DoctorID = $_POST['DoctorID'];


$query = $mysqli->prepare('insert into patient(PatientID, UserID, DoctorID) 
values(?,?,?)');
$query->bind_param('ii', $PatientID , $UserID, $DoctorID);
$query->execute();

$response = [];
$response["status"] = "true";

echo json_encode($response);
