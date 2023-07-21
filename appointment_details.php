<?php
// appointment_status.php

// Start the session
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['patient_email'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit;
}

// Include the file containing database information
require_once 'data.php';

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the appointment status for the logged-in patient
$patient_email = $_SESSION['patient_email'];

$sql = "SELECT id, fname, lname, age, email, pre_conditions, status, appointment_date, doctor, prescriptions, pres_price 
        FROM appointment 
        WHERE email = '$patient_email'";

$result = $conn->query($sql);

// Check if the patient has an appointment
if ($result->num_rows > 0) {
    // Fetch the appointment data
    $appointment = $result->fetch_assoc();

    // Redirect to the patient's appointment page
    header("Location: appointment_page.php?id=" . $appointment['id']);
    exit;
} else {
    // If no appointment found for the patient
    echo "No appointment found for this patient.";
}

// Close the database connection
$conn->close();
?>


