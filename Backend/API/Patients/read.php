<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$PatientID = $_POST['PatientID'];

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
        Patient ON Users.UserID = Patient.UserID
    WHERE
        Patient.PatientID = ?
');

$query->bind_param('s', $PatientID);
$query->execute();
$query->store_result();

// Bind the results to variables
$query->bind_result($UserID, $Username, $FirstName, $LastName, $Email, $Address, $Specialization);

$response = [];

if ($query->num_rows > 0) {
    // Fetch the results
    $query->fetch();

    $response['status'] = 'Success';
    $response['user_id'] = $UserID;
    $response['Username'] = $Username;
    $response['Email'] = $Email;
    $response['Address'] = $Address;
    $response['Specialization'] = $Specialization;
} else {
    $response['status'] = 'Error';
    $response['message'] = 'Patient not found';
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
