<?php
header('Access-Control-Allow-Origin: *');
include("../../connection.php");

$AvailabilityID = $_POST['AvailabilityID'];

$query = $mysqli->prepare('
    DELETE AvailabilityCalendar
    FROM AvailabilityCalendar
    WHERE AvailabilityCalendar.AvailabilityID = ?
');

$query->bind_param('i', $AvailabilityID);
$query->execute();

// Check if any rows were affected
$rowsAffected = $mysqli->affected_rows;

$response = [];

if ($rowsAffected > 0) {
    $response['status'] = 'Deleted';
} else {
    $response['status'] = 'Error';
    $response['message'] = 'request not found or already deleted';
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
