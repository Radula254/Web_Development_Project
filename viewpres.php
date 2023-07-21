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
    <h1>MedEase Prescriptions Data:</h1>

    <?php
    // Start the session to access session data
    session_start();

    // Check if the user is logged in and the pharmacist's full name is stored in the session
    if (isset($_SESSION['pharmacist_fullname'])) {
        $pharmacistFullName = $_SESSION['pharmacist_fullname'];
        echo "<h3 style='color: black; ;'><u>Welcome $pharmacistFullName!</u></h3>";
    } else {
        header('Location: login.php');
        exit();
    }
    ?>
    </div>


    <?php
    include("data.php");

    // Retrieve data from the database
    $query = "SELECT id, fname, lname, prescriptions, frequency, pres_price FROM appointment";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Prescriptions</th><th>Frequency</th><th>Price</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['fname'] . ' ' . $row['lname'];
            $prescriptions = $row['prescriptions'];
            $frequency = $row['frequency'];
            $Price = $row['pres_price'];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$prescriptions</td>";
            echo "<td>$frequency</td>";
            echo "<td>$Price</td>";
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
