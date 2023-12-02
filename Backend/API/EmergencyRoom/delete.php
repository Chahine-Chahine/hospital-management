<?php
header('Access-Control-Allow-Origin: *');
include("../../connection.php");

$RequestID = $_POST['RequestID'];

$query = $mysqli->prepare('
    DELETE emergencyroomrequests
    FROM emergencyroomrequests
    WHERE emergencyroomrequests.RequestID = ?
');

$query->bind_param('s', $RequestID);
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
