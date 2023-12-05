<?php

header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$DoctorID = $_POST['DoctorID'];

$Username = $_POST['Username'];
$RawPassword = $_POST['Password']; // Assuming you receive the raw, unhashed password
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Email = $_POST['Email'];
$Address = $_POST['Address'];
$Specialization = $_POST['Specialization'];
$RoleID = $_POST['RoleID']; // Assuming you have RoleID in your form data

// Hash the password
$HashedPassword = password_hash($RawPassword, PASSWORD_DEFAULT);

$insertUserQuery = $mysqli->prepare('INSERT INTO Users (RoleID, Username, Password, FirstName, LastName, Email, Address, Specialization) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$insertUserQuery->bind_param('isssssss', $RoleID, $Username, $HashedPassword, $FirstName, $LastName, $Email, $Address, $Specialization);
$insertUserQuery->execute();

$UserID = $mysqli->insert_id;

$insertDoctorQuery = $mysqli->prepare('INSERT INTO Doctors (DoctorID, UserID) VALUES (?, ?)');
$insertDoctorQuery->bind_param('ii', $DoctorID, $UserID);
$insertDoctorQuery->execute();

$query = $mysqli->prepare('
    SELECT
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
        Doctors ON Users.UserID = Doctors.UserID
    WHERE
        Doctors.DoctorID = ?
');

$query->bind_param('s', $DoctorID);
$query->execute();
$query->store_result();

$query->bind_result($UserID, $Username, $FirstName, $LastName, $Email, $Address, $Specialization);

$response = [];

if ($query->num_rows > 0) {
    $query->fetch();

    $response['status'] = 'Success';
    $response['user_id'] = $UserID;
    $response['Username'] = $Username;
    $response['Email'] = $Email;
    $response['Address'] = $Address;
    $response['Specialization'] = $Specialization;
} else {
    $response['status'] = 'Error';
    $response['message'] = 'Doctor not found';
}

echo json_encode($response);

$query->close();
$insertUserQuery->close();
$insertDoctorQuery->close();

$mysqli->close();
?>
