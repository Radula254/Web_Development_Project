<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <link rel="stylesheet" href="display.css">
    <link rel="stylesheet" href="panel2.css">
    <title>MedEase - Doctor</title>
    
</head>
<body>
    <section id="header">
        <a href="#"><img src="logo7.jpg" class="logo" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
                <li><a href="services.html">Servises</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="http://localhost/Medease/logout.php">Logout</a></li>
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
    if (isset($_SESSION['doctor_fullname'])) {
        $doctorFullName = $_SESSION['doctor_fullname'];
        echo "<h3 style='color: black;'><u>Welcome $doctorFullName!</u></h3>";
    } else {
        //if not they are directed to:
        header('Location: login.php');
        exit();
    }
    ?>


    <section id="form1">
        <?php
        require_once 'data.php';

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $appointmentId = $_POST['appointment_id'];
            $prescriptions = $_POST['prescriptions'];
            $frequency = $_POST['frequency'];

            // Prepare and execute the SQL statement to update the appointment data
            $stmt = $conn->prepare("UPDATE appointment SET prescriptions = ?, frequency = ?, status = 'Consulted' WHERE id = ?");
            $stmt->bind_param("sss", $prescriptions, $frequency, $appointmentId);
            $stmt->execute();

            // Close the statement
            $stmt->close();

            echo "<p>Consultation updated successfully.</p>";
        }
        ?>

         <h3>Doctor's Panel</h3>
        <div class="receptionist-form">
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Pre-Conditions</th>
                    <th>Appointment Date</th>
                    <th>Doctor</th>
                    <th class="spaced-words">Prescription Frequency</th>
                    
                    
                </tr>
                <?php
            // Retrieve booked appointments from the database
            $query = "SELECT * FROM appointment WHERE status = 'Booked'";
            $result = $conn->query($query);

            // Display the booked appointments in a table
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['fname']."</td>";
                echo "<td>".$row['lname']."</td>";
                echo "<td>".$row['age']."</td>";
                echo "<td>".$row['pre-conditions']."</td>";
                echo "<td>".$row['appointment_date']."</td>";
                echo "<td>".$row['doctor']."</td>";

                echo "<td>
                <form method='post'>
                    <input type='hidden' name='appointment_id' value='".$row['id']."'>
                    <input type='text' name='prescriptions' required>
                    <input type='text' name='frequency' placeholder=' 1 x 1' required>
                    <button type='submit' class='normal'>Submit</button>
                        </form></td>";
                    echo "</tr>";
            }

            // Close the result set
            $result->close();
            ?>
        </table>
    </div>
    </section>

    

    <!-- HTML form to input fname and lname for filtering -->
    <h5>Search for Patient</h5>
    <form method="post" action="psearch.php">
        <div id="search">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" required>
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" required>
            <div id="search-bar">
               <button type="submit">Search</button>
            </div>
        </div>
    </form>
</form>
</body>
</html>