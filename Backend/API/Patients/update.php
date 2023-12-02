<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$PatientID = $_POST['PatientID'];
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Address = $_POST['Address'];
$Specialization = $_POST['Specialization'];

$query = $mysqli->prepare('
    UPDATE Users
    INNER JOIN Patient ON Users.UserID = Patient.UserID
    SET
        Users.Username = ?,
        Users.Email = ?,
        Users.Address = ?,
        Users.Specialization = ?
    WHERE
        Patient.PatientID = ?
');

$query->bind_param('sssss', $Username, $Email, $Address, $Specialization, $PatientID);
$query->execute();

$response = [];

if ($mysqli->affected_rows > 0) {
    $response['status'] = 'Success';
    $response['message'] = 'Patient updated successfully';
} else {
    $response['status'] = 'Error';
    $response['message'] = 'Patient not found or no changes made';
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
