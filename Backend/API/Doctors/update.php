<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$DoctorID = $_POST['DoctorID'];
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Address = $_POST['Address'];
$Specialization = $_POST['Specialization'];

$query = $mysqli->prepare('
    UPDATE Users
    INNER JOIN Doctors ON Users.UserID = Doctors.UserID
    SET
        Users.Username = ?,
        Users.Email = ?,
        Users.Address = ?,
        Users.Specialization = ?
    WHERE
        Doctors.DoctorID = ?
');

$query->bind_param('sssss', $Username, $Email, $Address, $Specialization, $DoctorID);
$query->execute();

$response = [];

if ($mysqli->affected_rows > 0) {
    $response['status'] = 'Success';
    $response['message'] = 'Doctor updated successfully';
} else {
    $response['status'] = 'Error';
    $response['message'] = 'Doctor not found or no changes made';
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
