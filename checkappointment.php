<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <title>MedEase</title>
    <link rel = "stylesheet" href="display.css">
</head>
<body>
    <div id="head">
    <h1>MedEase Patient Data:</h1>
    </div>

    <?php
    // Start the session
    session_start();

    // Check if the patient is logged in
    if (!isset($_SESSION['patient_email'])) {
        // Redirect to the login page if not logged in
        header('Location: login.php');
        exit;
    }

    include("data.php");
    
    $email = $_SESSION['email'];

    // Retrieve data from the database
    $query = "SELECT fname, lname, age, email, `pre-conditions`, status, appointment_date, doctor, prescriptions, frequency, pres_price FROM appointment WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>age</th><th>email</th><th>Pre-Conditions</th><th>Appointment Date</th><th>Doctor</th><th>Prescriptions</th><th>Frequency</th><th>Prescription Price</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['fname'] . ' ' . $row['lname'];
            $age = $row['age'];
            $email = $row['email'];
            $preconditions = $row['pre-conditions'];
            $appointment_date = $row['appointment_date'];
            $doctor = $row['doctor'];
            $prescriptions = $row['prescriptions'];
            $frequency = $row['frequency'];
            $pres_price = $row['pres_price'];

            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$age</td>";
            echo "<td>$email</td>";
            echo "<td>$preconditions</td>";
            echo "<td>$appointment_date</td>";
            echo "<td>$doctor</td>";
            echo "<td>$prescriptions</td>";
            echo "<td>$frequency</td>";
            echo "<td>$pres_price</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    mysqli_close($conn);
    ?>

<button id="search" onclick="goBack()">Back</button>

<script>
    // JavaScript function to go back to the previous page
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
