<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");


$DoctorID = $_POST['DoctorID'];
$UserID = $_POST['UserID'];


$query = $mysqli->prepare('insert into doctor(DoctorID, UserID) 
values(?,?)');
$query->bind_param('ii', $DoctorID , $UserID);
$query->execute();

$response = [];
$response["status"] = "true";

echo json_encode($response);
