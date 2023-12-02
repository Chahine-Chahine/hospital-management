<?php
header('Access-Control-Allow-Origin: *');
include("../../connection.php");

$PatientID = $_POST['PatientID'];

$query = $mysqli->prepare('
    DELETE Users, Patient
    FROM Users
    INNER JOIN Patient ON Users.UserID = Patient.UserID
    WHERE Patient.PatientID = ?
');

$query->bind_param('s', $PatientID);
$query->execute();

// Check if any rows were affected
$rowsAffected = $mysqli->affected_rows;

$response = [];

if ($rowsAffected > 0) {
    $response['status'] = 'Deleted';
} else {
    $response['status'] = 'Error';
    $response['message'] = 'Patient not found or already deleted';
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
