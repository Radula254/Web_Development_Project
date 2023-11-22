<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    
    <link rel="stylesheet" href="panel.css">

    <title>MedEase Pharmacy</title>

    <style>
        body{
            width: 100%;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            background-color: #87CEEB;
        }
        button {
            background-color: #791597;
            color: #fff;
            padding: 9px 15px;
            margin-left: 4px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: 700;
            font-size: 13px;
            border: none;
            border-radius: 5px ;
        }

        #form{
            background-color: #87CEEB;
        }

        button:hover {
            background-color: #088178;
        }
        label{
            font-size: large;
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
                <a href="#" id="close"><i class="fa fa-times" aria-hidden="true"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>

        
    </section>

    <section id="form">

    <?php
    // Start the session to access session data
    session_start();

    // Check if the user is logged in and the pharmacist's full name is stored in the session
    if (isset($_SESSION['pharmacist_fullname'])) {
        $pharmacistFullName = $_SESSION['pharmacist_fullname'];
        echo "<h3 style='color: black; '><u>Welcome $pharmacistFullName!</u></h3>";
    } else {
        header('Location: login.php');
        exit();
    }
    ?>

        <?php
        // Include the data.php file for the database connection
        require_once 'data.php';

        // Handle form submission to add a new drug
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['add'])) {
                $meds = $_POST['meds'];
                $price = $_POST['price'];
        
                // Prepare and execute the SQL statement to insert the drug data
                $stmt = $conn->prepare("INSERT INTO medicine (meds, price) VALUES (?, ?)");
                $stmt->bind_param("ss", $meds, $price);
                $stmt->execute();
        
                // Close the statement
                $stmt->close();
        
                echo "<p>Drug Added Successfully.</p>";
            } elseif (isset($_POST['edit'])) {
                // Retrieve the form data
                $meds = $_POST['meds'];
                $newMeds = $_POST['new_meds'];
                $newPrice = $_POST['new_price'];
                
                // Prepare and execute the SQL statement to update the drug details
                $stmt = $conn->prepare("UPDATE medicine SET meds = ?, price = ? WHERE meds = ?");
                $stmt->bind_param("sss", $newMeds, $newPrice, $meds);
                $stmt->execute();
                
                // Close the statement
                $stmt->close();
                
                echo "Drug updated successfully.";
            } elseif (isset($_POST['search'])) {
                $meds = $_POST['meds'];

                // Prepare the SQL statement to search for a drug by name
                $stmt = $conn->prepare("SELECT * FROM medicine WHERE meds = ?");
                $stmt->bind_param('s', $meds);
                $stmt->execute();

                $result = $stmt->get_result();
                $drug = $result->fetch_assoc();
            }
        }
        ?>

        <h3>Add Drugs</h3><br>
        <div class="patient-form">
            <form method="post">
                <label for="meds">Drug </label><br>
                <input type="text" name="meds" id="meds" required><br>
                <label for="price">Drug Price</label><br>
                <input type="text" name="price" id="price" placeholder="ksh.000" required><br>
                <button type="submit" name="add" class="normal">Submit</button>
                <button type="reset" class="normal">Reset</button><br>
            </form>
        </div>

        <h3>Edit Drugs</h3><br>
        <div class="patient-form">
            <form method="post">
                <label for="meds">Drug </label><br>
                <input type="text" name="meds" id="meds" required><br>
                <label for="new_meds">New Drug</label><br>
                <input type="text" name="new_meds" id="new_meds" required><br>
                <label for="new_price">New Drug Price</label><br>
                <input type="text" name="new_price" id="new_price" placeholder="ksh.000" required><br>
                <button type="submit" name="edit" class="normal">Edit</button>
            </form>
        </div>

        <div class="patient-form">
    <form method="post">
        <label for="meds">Drug </label><br>
        <input type="text" name="meds" id="meds" required><br>
        <button type="submit" name="search" class="normal">Search</button><br>
    </form>
    <?php
    // Display the drug details if the search form is submitted
    if (isset($drug)) {
        if ($drug) {
            echo "<h4 style='color: black;'>Drug Details</h4>";
            echo "Drug Name: " . $drug["meds"] . "<br>";
            echo "Drug Price: " . $drug["price"] . "<br>";
        } else {
            echo "<p>Drug not found in the database.</p>";
        }
    }
    ?>

    </section>
</body>
</html>
