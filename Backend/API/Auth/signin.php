<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
include("../../connection.php");



$Email = $_POST['Email'];
$Password = $_POST['Password'];
$query=$mysqli->prepare('select UserID,RoleID,Password from users where Email=?');
$query->bind_param('s',$Email);
$query->execute();
$query->store_result();
$num_rows=$query->num_rows;
$query->bind_result($UserID,$RoleID,$hashed_password);
$query->fetch();


$response=[];
if($num_rows== 0){
    $response['status']= 'user not found';
    echo json_encode($response);
} else {
    if(password_verify($Password,$hashed_password)){
        $response['status']= 'logged in';
        $response['RoleID']=$RoleID;
        $response['user_id']=$UserID;
        $response['Email']=$Email;
        echo json_encode($response);
    } else {
        $response['status']= 'wrong credentials';
        echo json_encode($response);
    }
};