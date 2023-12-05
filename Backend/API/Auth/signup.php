<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
include("../../connection.php");


$RoleID = $_POST['RoleID'];
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Address = $_POST['Address'];
$Specialization = $_POST['Specialization'];

$hashed_password = password_hash($Password, PASSWORD_DEFAULT);

$query = $mysqli->prepare('insert into users(RoleID,Username,Password,FirstName,LastName,Email,Address,Specialization) 
values(?,?,?,?,?,?,?,?)');
$query->bind_param('isssssss', $RoleID, $Username,$hashed_password , $FirstName , $LastName , $Email, $Address , $Specialization);
$query->execute();

$response = [];
$response["status"] = "true";

echo json_encode($response);
