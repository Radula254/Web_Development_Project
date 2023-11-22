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
                <li><a href="index.html">Home</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="http://localhost/Medease/logout.php"></a></li>
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
    if (isset($_SESSION['pharmacist_fullname'])) {
        $pharmacistFullName = $_SESSION['pharmacist_fullname'];
        echo "<h3 style='color: black;'><u>Welcome $pharmacistFullName!</u></h3>";
    } else {
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
            $prescriptions_price = $_POST['pres_price'];

            // Prepare and execute the SQL statement to update the appointment data
            $stmt = $conn->prepare("UPDATE appointment SET pres_price = ?, status = 'Paid' WHERE id = ?");
            $stmt->bind_param("ss", $prescriptions_price, $appointmentId);
            $stmt->execute();

            // Close the statement
            $stmt->close();

            echo "<p>Precription price updated successfully.</p>";
        }
        ?>

        <h3>Pharmacist's Panel</h3><br>
        <div class="pharmasist-form">
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Doctor</th>
                    <th>Prescription</th>
                    <th>Frequency</th>
                    <th>Medicine</th>
                </tr>
                <?php
                // Retrieve booked appointments from the database
                $query = "SELECT * FROM appointment WHERE status = 'Consulted'";
                $result = $conn->query($query);

                // Display the booked appointments in a table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['fname']."</td>";
                    echo "<td>".$row['lname']."</td>";
                    echo "<td>".$row['doctor']."</td>";
                    echo "<td>".$row['prescriptions']."</td>";
                    echo "<td>".$row['frequency']."</td>";
                    echo "<td>
                    <form method='post'>
                        <input type='hidden' name='appointment_id' value='".$row['id']."'>
                        <select name='pres_price' required>
                            <option value='' selected disabled>Select Prescription</option>";
                        
                            // Include the data.php file for the database connection
                            require_once 'data.php';
            
                            // Fetch medicines from the 'medicine' table
                            $query = "SELECT id, meds, price FROM medicine";
                            $result = mysqli_query($conn, $query);
            
                            while ($medicine = mysqli_fetch_assoc($result)) {
                                // Output the medicine name as the option value and label
                                echo "<option value='" . $medicine['price'] . "'>" . $medicine['meds']  .' - '.  $medicine['price'] .  "</option>";
                            }
            
                            // Close the result set and the database connection
                        
                    echo "
                        </select>
                            <button type='submit' class='normal'>Dispense</button>

                    </form>
                    </td>";
                    echo "</tr>";
                }

                // Close the result set
                $result->close();
                ?>
            </table>
        </div>

        
    </section>

    <h5>Search for Patient</h5>
    <form method="post" action="pphsearch.php">
        <div id="search">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" required>
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" required>
            <div id="search-bar">
               <button type="submit">Search</button>
            </div>
        </div>

    

    

       
</body>
</html>