<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");


$PatientID = $_POST['PatientID'];
$AdminID = $_POST['AdminID'];
$RequestDateTime = $_POST['RequestDateTime'];
$ApprovalStatus = $_POST['ApprovalStatus'];


$query = $mysqli->prepare('insert into emergencyroomrequests(PatientID,AdminID, RequestDateTime, ApprovalStatus) 
values(?,?,?,?)');
$query->bind_param('iiss', $PatientID,$AdminID , $RequestDateTime, $ApprovalStatus);
$query->execute();

$response = [];
$response["status"] = "true";

echo json_encode($response);
