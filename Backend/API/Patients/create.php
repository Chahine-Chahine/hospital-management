<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");


$PatientID = $_POST['PatientID'];
$UserID = $_POST['UserID'];


$query = $mysqli->prepare('insert into patient(PatientID, UserID) 
values(?,?)');
$query->bind_param('ii', $PatientID , $UserID);
$query->execute();

$response = [];
$response["status"] = "true";

echo json_encode($response);
