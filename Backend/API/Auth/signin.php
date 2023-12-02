<?php
header('Access-Controll-Allow-Origin:*');
include("../../connection.php");


$Username = $_POST['Username'];
$Password = $_POST['Password'];
$query=$mysqli->prepare('select UserID,RoleID,Password from users where Username=?');
$query->bind_param('s',$Username);
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
        $response['user_id']=$UserID;
        $response['username']=$Username;
        echo json_encode($response);
    } else {
        $response['status']= 'wrong credentials';
        echo json_encode($response);
    }
};