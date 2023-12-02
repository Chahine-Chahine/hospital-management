<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");


$query=$mysqli->prepare('SELECT
Users.UserID,
Users.Username,
Users.FirstName,
Users.LastName,
Users.Email,
Users.Address,
Users.Specialization
FROM
Users
INNER JOIN
Doctor ON Users.UserID = Doctor.UserID;
');
$query->execute();
$array=$query->get_result();
$response=[];

while($Patient=$array->fetch_assoc()){
    $response[]=$Patient;
}
echo json_encode($response);