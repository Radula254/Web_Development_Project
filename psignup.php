<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    
    <div class="title">
        <h1>MEDEASE</h1>
    </div>

    <div class="login-box">
        <h2>Sign Up</h2>
        <?php
        include("data.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $pnumber = filter_input(INPUT_POST, "pnumber", FILTER_SANITIZE_NUMBER_INT);
            $password = filter_input(INPUT_POST, "password");
            

            if (empty($fname) || empty($lname) || empty($email) || empty($pnumber) || empty($password)) {
                echo "Please fill in all the fields";
            } else {
                // Prepare and execute the SQL query
                $stmt = $conn->prepare("INSERT INTO patients (fname, lname, email, pnumber, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $fname, $lname, $email, $pnumber, $password);

                if ($stmt->execute()) {
                    echo "Registration successful";
                    echo "<script>window.location.href = 'patientwelcome.html';</script>";
                    exit(); // Stop further execution of the PHP code
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }

            mysqli_close($conn);
        }
        ?>
        
        <form id="myForm" action="psignup.php" method="post">
            <div class="user-box">
                <input type="text" name="fname" required>
                <label>First name:</label>
            </div>
            <div class="user-box">
                <input type="text" name="lname" required>
                <label>Last Name:</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email:</label>
            </div>
            <div class="user-box">
                <input type="tel" name="pnumber" required>
                <label>Phone Number:</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password:</label>
            </div>
            <input type="submit" name="submit" value="Sign up" class="sign-up-btn">

        </form>
    </div>

</body>
</html>
