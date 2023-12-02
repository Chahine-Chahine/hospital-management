<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include("../../connection.php");

$RequestID = $_POST['RequestID'];
$PatientID = $_POST['PatientID'];

$query = $mysqli->prepare('
    SELECT
        EmergencyRoomRequests.*,
        Users.UserID,
        Users.Username,
        Users.FirstName,
        Users.LastName,
        Users.Email,
        Users.Address,
        Users.Specialization
    FROM
        EmergencyRoomRequests
    LEFT JOIN
        Patient ON EmergencyRoomRequests.PatientID = Patient.PatientID
    LEFT JOIN
        Users ON Patient.UserID = Users.UserID
    WHERE
        EmergencyRoomRequests.RequestID = ?
');

$query->bind_param('s', $RequestID);
$query->execute();
$result = $query->get_result();

$response = [];

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Include emergency room request data
    $response['status'] = 'Success';
    $response['requestID'] = $row['RequestID'];
    $response['patientID'] = $row['PatientID'];
    $response['adminID'] = $row['AdminID'];
    $response['requestDateTime'] = $row['RequestDateTime'];
    $response['approvalStatus'] = $row['ApprovalStatus'];
    // Include other columns from EmergencyRoomRequests table as needed

    // Include patient information
    $response['userID'] = $row['UserID'];
    $response['username'] = $row['Username'];
    $response['email'] = $row['Email'];
    $response['address'] = $row['Address'];
    $response['specialization'] = $row['Specialization'];
} else {
    $response['status'] = 'Error';
    $response['message'] = 'No data found for the given RequestID';
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
