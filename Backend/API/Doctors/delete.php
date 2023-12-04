<?php
header('Access-Control-Allow-Origin: *');
include("../../connection.php");

$DoctorID = $_POST['DoctorID'];

$query = $mysqli->prepare('
    DELETE Users, Doctors
    FROM Users
    INNER JOIN Doctors ON Users.UserID = Doctors.UserID
    WHERE Doctors.DoctorID = ?
');

$query->bind_param('s', $DoctorID);
$query->execute();

// Check if any rows were affected
$rowsAffected = $mysqli->affected_rows;

$response = [];

if ($rowsAffected > 0) {
    $response['status'] = 'Deleted';
} else {
    $response['status'] = 'Error';
    $response['message'] = 'Doctor not found or already deleted';
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
