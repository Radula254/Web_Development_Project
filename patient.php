<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <link rel="stylesheet" href="panel2.css">
    <link rel="stylesheet" href="panel.css">
    <title>MedEase - Patient</title>

    <style>
        label{
            font-size: large;
        }
        body{
            width:100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #87CEEB;
        }
        #form1 {
            background-color: #87CEEB;
            padding-left: 15px;
        }

        .app{
            background-color: #791597;
            color: #fff;
            padding: 9px 15px;
            margin-left: 4px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: 700;
            font-size: 30px;
            border: none;
            border-radius: 5px 
        }
        button{
            background-color: #791597;
            color: #fff;
            padding: 9px 15px;
            margin-left: 4px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: 700;
            font-size: 13px;
            border: none;
            border-radius: 5px 
        }
        input {
            height: 35px;
            width: 250px; /* Set the height of the select element */
            font-size: 16px; /* Set the font size of the options */
        }
        
    </style>
</head>
<body>
    <section id="header">
        <a href="#"><img src="logo7.jpg" class="logo" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="http://localhost/Medease/logout.php">Logout</a></li>
                <a href="#" id="close"><i class="fa fa-times" aria-hidden="true"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    

    <section id="form1" >
    <?php
    // Start the session to access session data
    session_start();

    if (isset($_SESSION['patient_fullname'])) {
        $patientFullName = $_SESSION['patient_fullname'];
        echo "<h2 style='color: black;'><u>Welcome $patientFullName!</u></h2>";
    } else {
        header('Location: login.php');
        exit();
    }
    ?>
        <?php
        // Include the data.php file for the database connection
        require_once 'data.php';

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $conditions = $_POST['conditions'];

            // Prepare and execute the SQL statement to insert the appointment data
            $stmt = $conn->prepare("INSERT INTO appointment (fname, lname, age, email,`pre-conditions`, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
            $stmt->bind_param("ssiss", $fname, $lname, $age, $email, $conditions);
            $stmt->execute();

            // Close the statement
            $stmt->close();

            echo "<p>Appointment booked successfully.</p>";
        }
        ?>

        <h2><u>Book Appointment</u></h2><br>
        <div class="patient-form">
            <form method="post">
                <label>Patient First Name</label><br>
                <input type="text" name="fname" required><br>
                <label>Patient Last Name</label><br>
                <input type="text" name="lname" required><br>
                <label>Patient Age</label><br>
                <input type="number" name="age" required><br>
                <label>Email:</label><br>
                <input type="email" name="email" required><br>
                <label>Any Pre-Existing Conditions</label><br>
                <input type="text" name="conditions" required><br>
                <button type="submit" class="normal">Submit</button>
                <button type="reset" class="normal">Reset</button><br>
                <a href="http://localhost/Medease/checkappointment.php">
                    <button type="button" class="app">Check Appointment Status</button>
                </a>

            
                
               
                
                
            </form>
        </div>
    </section>

   
</body>
</html>
