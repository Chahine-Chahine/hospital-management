<?php
header('Access-Control-Allow-Origin: *');
include("../../connection.php");

$AppointmentID = $_POST['AppointmentID'];

$query = $mysqli->prepare('
SELECT
Appointment.AppointmentID,
Appointment.PatientID,
Appointment.DoctorID,
Appointment.AppointmentDateTime,
Appointment.Status,
Users.FirstName AS DoctorName,
Users.LastName AS DoctorLastName,
Users.Specialization AS DoctorSpecialization
FROM
Appointment
INNER JOIN
Patient ON Appointment.PatientID = Patient.PatientID
INNER JOIN
Doctor ON Appointment.DoctorID = Doctor.DoctorID
INNER JOIN
Users ON Doctor.UserID = Users.UserID
WHERE
Appointment.AppointmentID = ?
');

$query->bind_param('i', $AppointmentID);
$query->execute();

// Check for errors in the query execution
if ($query->errno) {
    $response['status'] = 'Error';
    $response['message'] = 'Query execution error: ' . $query->error;
} else {
    $query->store_result();

    // Bind the results to variables
    $query->bind_result(
        $AppointmentID,
        $PatientID,
        $DoctorID,
        $AppointmentDateTime,
        $Status,
        $PatientFirstName,
        $PatientLastName,
        $DoctorSpecialization
    );

    if ($query->num_rows > 0) {
        // Fetch the results
        $query->fetch();

        // Store results in an associative array
        $response = [
            'status' => 'Success',
            'AppointmentID' => $AppointmentID,
            'PatientID' => $PatientID,
            'DoctorID' => $DoctorID,
            'AppointmentDateTime' => $AppointmentDateTime,
            'Status' => $Status,
            'DoctorName' => $PatientFirstName,
            'DoctorLastName' => $PatientLastName,
            'DoctorSpecialization' => $DoctorSpecialization,
        ];
    } else {
        $response['status'] = 'Error';
        $response['message'] = 'Appointment not found';
    }
}

echo json_encode($response);

// Close the statement
$query->close();
// Close the database connection
$mysqli->close();
?>
