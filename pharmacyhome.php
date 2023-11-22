<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin4.css">
    <link rel="stylesheet" href="index.csss">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <title>MedEase</title>
    <style>
        .data-card{
            margin: 2%;
        }
    </style>
</head>
<body>
<header>
        <nav>
            <ul class="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="http://localhost/Medease/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <?php
    // Start the session to access session data
    session_start();

    // Check if the user is logged in and the pharmacist's full name is stored in the session
    if (isset($_SESSION['pharmacist_fullname'])) {
        $pharmacistFullName = $_SESSION['pharmacist_fullname'];
        echo "<h3 style='color: black; margin: 1.5%;'><u>Welcome $pharmacistFullName!</u></h3>";
    } else {
        header('Location: login.php');
        exit();
    }
    ?>

<section class="content">
            <div class="data-section">
            <div class="data-card">
        <a href="http://localhost/Medease/pharmacy.php">
            <img src="feature3.png" alt="Doctor">
            <h3>Dispense Drugs</h3>
        </a>
    </div>
    <div class="data-card">
        <a href="http://localhost/Medease/viewpres.php">
            <img src="feature3.png" alt="Doctor">
            <h3>View Patients Prescriptions Data</h3>
        </a>
    </div>
    <div class="data-card">
        <a href="http://localhost/Medease/pharmacy.php">
            <img src="feature3.png" alt="Doctor">
            <h3>Search Patients Prescriptions Data</h3>
        </a>
    </div>
    <div class="data-card">
        <a href="http://localhost/Medease/adddrugs.php">
            <img src="feature3.png" alt="Doctor">
            <h3>Add/Edit Drugs</h3>
        </a>
    </div>
    <div class="data-card">
        <a href="http://localhost/Medease/ddetails.html">
            <img src="feature3.png" alt="Doctor">
            <h3>Insert Drug Records</h3>
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