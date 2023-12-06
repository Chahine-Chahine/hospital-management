<?php
header('Access-Control-Allow-Origin:*');
include("../../connection.php");

$PatientID = $_POST['PatientID'];
$DoctorID = isset($_POST['DoctorID']) ? $_POST['DoctorID'] : null; 


$Username = $_POST['Username'];
$Password = $_POST['Password'];
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Email = $_POST['Email'];
$Address = $_POST['Address'];
$Specialization = $_POST['Specialization'];
$RoleID = isset($_POST['RoleID']) ? $_POST['RoleID'] : 3;

$insertUserQuery = $mysqli->prepare('INSERT INTO Users (RoleID, Username, Password, FirstName, LastName, Email, Address, Specialization) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$insertUserQuery->bind_param('isssssss', $RoleID, $Username, $Password, $FirstName, $LastName, $Email, $Address, $Specialization);
$insertUserQuery->execute();

$UserID = $mysqli->insert_id;

$insertPatientQuery = $mysqli->prepare('INSERT INTO Patients (PatientID, UserID, DoctorID) VALUES (?, ?, ?)');
$insertPatientQuery->bind_param('iii', $PatientID, $UserID, $DoctorID);
$insertPatientQuery->execute();


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
        Patients ON Users.UserID = Patients.UserID
    WHERE
        Patients.PatientID = ?
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

// Close the statements
$query->close();
$insertUserQuery->close();
$insertPatientQuery->close();

// Close the database connection
$mysqli->close();
?>
