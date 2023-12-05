<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$DoctorID = $_POST['DoctorID'];
$Date = $_POST['Date'];
$TimeSlotStart = $_POST['TimeSlotStart'];
$TimeSlotEnd = $_POST['TimeSlotEnd'];
$Status = $_POST['Status'];



$query = $mysqli->prepare('insert into AvailabilityCalendar(AvailabilityID,DoctorID, Date, TimeSlotStart,TimeSlotEnd , Status) 
values(?,?,?,?,?,?)');
$query->bind_param('iissss', $AvailabilityID, $DoctorID , $Date, $TimeSlotStart, $TimeSlotEnd, $Status);
$query->execute();

$response = [];
$response["status"] = "true";

echo json_encode($response);
