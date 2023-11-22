<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin4.css">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <title>MedEase</title>
    <style>
        .data-card{
            margin: 2%;
        }
    </style>
</head>
<body>
<section id="header">
        <a href="#"><img src="logo7.jpg" class="logo" alt=""></a>

        <div style="position: relative;">
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
    <?php
    // Start the session to access session data
    session_start();

    // Check if the user is logged in and the doctor's full name is stored in the session
    if (isset($_SESSION['doctor_fullname'])) {
        $doctorFullName = $_SESSION['doctor_fullname'];
        echo "<h3 style='color: black; margin: 1.5%;'><u>Welcome $doctorFullName!</u></h3>";
    } else {
        header('Location: login.php');
        exit();
    }
    ?>

<section class="content">
            <div class="data-section">
            <div class="data-card">
        <a href="http://localhost/Medease/dpanel.php">
            <img src="feature3.png" alt="Doctor">
            <h3>Incoming Patients</h3>
        </a>
    </div>
    <div class="data-card">
        <a href="http://localhost/Medease/dpanel.php">
            <img src="feature3.png" alt="Doctor">
            <h3>Search For Patients</h3>
        </a>
    </div>
    <div class="data-card">
        <a href="http://localhost/Medease/drugs.html">
            <img src="feature3.png" alt="Doctor">
            <h3>View Drug Records</h3>
        </a>
    </div>
            </div>
        </section>
    </section>


    
</body>
</html>