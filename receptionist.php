<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <link rel="stylesheet" href="display.css">
    <link rel="stylesheet" href="panel2.css">
    <title>MedEase - Receptionist</title>
</head>
<body>
    <section id="header">
        <a href="#"><img src="logo7.jpg" class="logo" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="about.html">About</a></li>
                <a href="#" id="close"><i class="fa fa-times" aria-hidden="true"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <?php
    // Start the session to access session data
    session_start();

    // Check if the user is logged in and the pharmacist's full name is stored in the session
    if (isset($_SESSION['receptionist_fullname'])) {
        $receptionistFullName = $_SESSION['receptionist_fullname'];
        echo "<h3 style='color: black;'><u>Welcome $receptionistFullName!</u></h3>";
    } else {
        //if not they are directed to:
        header('Location: login.php');
        exit();
    }
    ?>

    <section id="form">
        <?php
        // Include the data.php file for the database connection
        require_once 'data.php';

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $appointmentId = $_POST['appointment_id'];
            $appointmentDate = $_POST['appointment_date'];
            $doctor = $_POST['doctor'];

            // Prepare and execute the SQL statement to update the appointment data
            $stmt = $conn->prepare("UPDATE appointment SET appointment_date = ?, doctor = ?, status = 'Booked' WHERE id = ?");
            $stmt->bind_param("ssi", $appointmentDate, $doctor, $appointmentId);
            $stmt->execute();

            // Close the statement
            $stmt->close();

            echo "<p>Appointment updated successfully.</p>";
        }
        ?>

        <h3>Receptionist Panel</h3><br>
        <div class="receptionist-form">
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Pre-Conditions</th>
                    <th>Appointment Date</th>
                    <th>Action</th>
                </tr>
                <?php
                // Retrieve pending appointments from the database
                $query = "SELECT * FROM appointment WHERE status = 'Pending'";
                $result = $conn->query($query);

                // Display the pending appointments in a table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['fname']."</td>";
                    echo "<td>".$row['lname']."</td>";
                    echo "<td>".$row['age']."</td>";
                    echo "<td>".$row['pre-conditions']."</td>";
                    echo "<td>".$row['appointment_date']."</td>";
                    echo "<td>".$row['doctor']."</td>";
                    echo "<td><form method='post'>
                            <input type='hidden' name='appointment_id' value='".$row['id']."'>
                            <input type='datetime-local' name='appointment_date' required>
                            <input type='text' name='doctor' placeholder='Assign doctor' required>
                            <button type='submit' class='normal'>Book</button>
                        </form></td>";
                    echo "</tr>";
                }

                // Close the result set
                $result->close();
                ?>
            </table>
        </div>
    </section>

    
</body>
</html>
