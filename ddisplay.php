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
    <h1>MedEase Doctors Data:</h1>
    </div>

    <?php
    include("data.php");

    // Retrieve data from the database
    $query = "SELECT id, fname, lname, DOE, department, speciality, email, pnumber FROM doctors";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>DOE</th><th>department</th><th>speciality</th><th>Email</th><th>Phone Number</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['fname'] . ' ' . $row['lname'];
            $DOE = $row['DOE'];
            $department = $row['department'];
            $speciality = $row['speciality'];
            $email = $row['email'];
            $pnumber = $row['pnumber'];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$DOE</td>";
            echo "<td>$department</td>";
            echo "<td>$speciality</td>";
            echo "<td>$email</td>";
            echo "<td>$pnumber</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
