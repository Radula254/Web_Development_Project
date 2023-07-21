<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedEase Admin Panel</title>
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="admin4.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
            </ul>
        </nav>
    </header>

    <?php
    // Start the session to access session data
    session_start();

    if (isset($_SESSION['admin_fullname'])) {
        $adminFullName = $_SESSION['admin_fullname'];
        echo "<h3 style='color: black; padding-top: 1%; padding-left: 1%;'><u>Welcome $adminFullName!</u></h3>";
    } else {
        header('Location: login.php');
        exit();
    }
    ?>

    <section class="container">
        <aside class="side-menu">
            <div class="brand-name">
                <h1>Admin Panel</h1>
            </div>
            <ul class="role-list">
                <li><a href="http://localhost/Medease/admincrud.php"><i class="fas fa-user-circle"></i> Admins</a></li>
                <li><a href="http://localhost/Medease/dmadmin.php"><i class="fas fa-user-tie"></i> Managers</a></li>
                <li><a href="http://localhost/Medease/dadmin.php"><i class="fas fa-user-md"></i> Doctors</a></li>
                <li><a href="http://localhost/Medease/nadmin.php"><i class="fas fa-user-nurse"></i> Nurses</a></li>
                <li><a href="http://localhost/Medease/radmin.php"><i class="fas fa-user-check"></i> Receptionists</a></li>
                <li><a href="http://localhost/Medease/phadmin.php"><i class="fas fa-user-md"></i> Pharmacists</a></li>
            </ul>
        </aside>

        <section class="content">
            <h2>Data Display</h2>
            <div class="data-section">
                <div class="data-card">
                    <a href="http://localhost/Medease/dmdisplay.php">
                        <img src="feature3.png" alt="Manager">
                        <h3>Managers</h3>
                    </a>
                </div>
                <div class="data-card">
                    <a href="http://localhost/Medease/ddisplay.php">
                        <img src="feature3.png" alt="Doctor">
                        <h3>Doctors</h3>
                    </a>
                </div>
                <div class="data-card">
                    <a href="http://localhost/Medease/ndisplay.php">
                        <img src="feature3.png" alt="Nurse">
                        <h3>Nurses</h3>
                    </a>
                </div>
                <div class="data-card">
                    <a href="http://localhost/Medease/rdisplay.php">
                        <img src="feature3.png" alt="Receptionist">
                        <h3>Receptionists</h3>
                    </a>
                </div>
                <div class="data-card">
                    <a href="http://localhost/Medease/phdisplay.php">
                        <img src="feature3.png" alt="Pharmacist">
                        <h3>Pharmacists</h3>
                    </a>
                </div>
                <div class="data-card">
                    <a href="http://localhost/Medease/pdisplay.php">
                        <img src="feature3.png" alt="Patient">
                        <h3>Patients</h3>
                    </a>
                </div>
                <div class="data-card">
                    <a href="http://localhost/Medease/viewpres.php">
                        <img src="feature3.png" alt="Patient">
                        <h3>Prescriptions</h3>
                    </a>
                </div>
                <div class="data-card">
                    <a href="http://localhost/Medease/Codisplay.php">
                        <img src="feature3.png" alt="Patient">
                        <h3>Pharmaceuticals</h3>
                    </a>
                </div>
                <div class="data-card">
                    <a href="http://localhost/Medease/checkappointment.php">
                        <img src="feature3.png" alt="Patient">
                        <h3>Appointments</h3>
                    </a>
                </div>
            </div>
        </section>
    </section>
    <!--
    <footer class="section-p1">
        <div class="col">
            <img src="logo2.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong>489 Kitusuri Road, Street 77, Nairobi</p>
            <p><strong>Phone: </strong> +254 797 093 831 /(020) 01 1436 1483</p>
            <p><strong>Hours: </strong> 24/7, Including Holidays</p>
            <button class="normal" onclick="window.location.href='index.html'">Home</button><br><br>
            <div class="follow">
                <div class="icon">
                    <a href="https://twitter.com/home" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://web.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
    -->
</body>
</html>
