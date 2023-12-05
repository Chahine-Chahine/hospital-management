<?php
header('Access-Control-Allow-Origin: *');
include("../../connection.php");

$DoctorID = $_POST['DoctorID'];

// Start a transaction
$mysqli->begin_transaction();

try {
    // Delete records from Appointments table
    $deleteAppointmentsQuery = $mysqli->prepare('DELETE FROM Appointments WHERE DoctorID = ?');
    $deleteAppointmentsQuery->bind_param('s', $DoctorID);
    $deleteAppointmentsQuery->execute();
    $deleteAppointmentsQuery->close();

    // Delete records from PatientRecords table
    $deletePatientRecordsQuery = $mysqli->prepare('DELETE FROM PatientRecords WHERE DoctorID = ?');
    $deletePatientRecordsQuery->bind_param('s', $DoctorID);
    $deletePatientRecordsQuery->execute();
    $deletePatientRecordsQuery->close();

    // Delete records from Users and Doctors tables
    $deleteQuery = $mysqli->prepare('
        DELETE Users, Doctors
        FROM Users
        INNER JOIN Doctors ON Users.UserID = Doctors.UserID
        WHERE Doctors.DoctorID = ?
    ');
    $deleteQuery->bind_param('s', $DoctorID);
    $deleteQuery->execute();

    // Check if any rows were affected
    $rowsAffected = $mysqli->affected_rows;

    if ($rowsAffected > 0) {
        // Commit the transaction
        $mysqli->commit();

        $response['status'] = 'Deleted';
    } else {
        $response['status'] = 'Error';
        $response['message'] = 'Doctor not found or already deleted';
    }
} catch (Exception $e) {
    // An error occurred, rollback the transaction
    $mysqli->rollback();

    $response['status'] = 'Error';
    $response['message'] = 'An error occurred while deleting the doctor: ' . $e->getMessage();
}

// Close the database connection
$mysqli->close();

echo json_encode($response);
?>
