<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include("../../connection.php");

$RequestID = $_POST['RequestID'];
$PatientID = $_POST['PatientID'];
$AdminID = $_POST['AdminID'];  
$RequestDateTime = $_POST['RequestDateTime'];
$ApprovalStatus = $_POST['ApprovalStatus'];

$query = $mysqli->prepare('
    UPDATE EmergencyRoomRequests
    SET
        PatientID = ?,
        AdminID = ?,
        RequestDateTime = ?,
        ApprovalStatus = ?
    WHERE
        RequestID = ?
');

$query->bind_param('sssss', $PatientID, $AdminID, $RequestDateTime, $ApprovalStatus, $RequestID);
$query->execute();

$response = [];

if ($query->affected_rows > 0) {
    $response['status'] = 'Success';
    $response['message'] = 'Emergency room request updated successfully';
} else {
    $response['status'] = 'Error';
    $response['message'] = 'Failed to update emergency room request. Check the provided RequestID.';
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
