<?php
require_once "data.php"; // Include the database connection file

// Add admin
if (isset($_POST['add'])) {
    // Retrieve the form data
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $date_of_employment = $_POST['DOE'];
    $email = $_POST['email'];
    $pnumber = $_POST['pnumber'];
    $salary = $_POST['salary'];
    $password = $_POST['password'];

    // Perform validation on the data
    $errors = array();

    // Validate first name and last name (not empty and alphanumeric)
    if (empty($first_name) || empty($last_name)) {
        $errors[] = "First name and last name are required.";
    }

    // Validate email (not empty and a valid email format)
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate phone number (not empty and numeric)
    if (empty($pnumber) || !is_numeric($pnumber)) {
        $errors[] = "Phone number is required and should be numeric.";
    }

    // If there are no validation errors, proceed with inserting the admin into the database
    if (empty($errors)) {
        // Prepare and execute the SQL statement to insert the admin into the 'admins' table
        $sql = "INSERT INTO admin (fname, lname, DOE, email, pnumber, salary, password)
                VALUES ('$first_name', '$last_name', '$date_of_employment', '$email', '$pnumber', '$salary', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                        var successMessage = document.createElement('div');
                        successMessage.textContent = 'Registration successful';
                        successMessage.style.backgroundColor = '#4CAF50';
                        successMessage.style.color = 'white';
                        successMessage.style.padding = '10px';
                        successMessage.style.textAlign = 'center';
                        successMessage.style.position = 'fixed';
                        successMessage.style.top = '50%';
                        successMessage.style.left = '50%';
                        successMessage.style.transform = 'translate(-50%, -50%)';
                        document.body.appendChild(successMessage);

                        // Hide the message after 2 seconds (2000 milliseconds)
                        setTimeout(function() {
                            successMessage.style.display = 'none';
                        }, 2000);

                        // Redirect the user to the index page after registration
                        setTimeout(function() {
                            window.location.href = 'index.html';
                        }, 2000);
                    </script>";
                    exit(); // Stop further execution of the PHP code
        } else {
            echo "Error adding Admin: " . $conn->error;
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}




// Edit admin
if (isset($_POST['edit'])) {
    // Retrieve the form data
    $admin_id = $_POST['id'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $pnumber = $_POST['pnumber'];
    $salary = $_POST['salary'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to update the admin's information
    $sql = "UPDATE admin SET ";

    // Build the update query based on the provided fields
    if (!empty($first_name)) {
        $sql .= "fname = '$first_name', ";
    }
    if (!empty($last_name)) {
        $sql .= "lname = '$last_name', ";
    }
    if (!empty($email)) {
        $sql .= "email = '$email', ";
    }
    if (!empty($pnumber)) {
        $sql .= "pnumber = '$pnumber', ";
    }
    if (!empty($salary)) {
        $sql .= "salary = '$salary', ";
    }
    if (!empty($password)) {
        $sql .= "password = '$password', ";
    }

    // Remove the trailing comma and space from the SQL statement
    $sql = rtrim($sql, ', ');

    // Add the WHERE clause to specify the admin to update
    $sql .= " WHERE id = $admin_id";

    if ($conn->query($sql) === TRUE) {
        echo "admin information updated successfully.";
    } else {
        echo "Error updating admin information: " . $conn->error;
    }
}

// Delete admin
if (isset($_POST['delete'])) {
    // Retrieve the form data
    $admin_id = $_POST['id'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];

    // Prepare the SQL statement to delete the admin
    $sql = "DELETE FROM admin WHERE ";

    // Build the WHERE clause based on the provided fields
    if (!empty($admin_id)) {
        $sql .= "id = $admin_id";
    } elseif (!empty($first_name) && !empty($last_name)) {
        $sql .= "fname = '$first_name' AND lname = '$last_name'";
    } else {
        echo "Please provide either the admin's ID or both the first and last name.";
        exit;
    }

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Update the remaining records' IDs
        $update_query = "UPDATE admin SET id = id - 1 WHERE id > $admin_id";
        if ($conn->query($update_query) === TRUE) {
            echo "Admin deleted successfully and IDs renumbered.";
        } else {
            echo "Error updating IDs: " . $conn->error;
        }
    } else {
        echo "Error deleting Admin: " . $conn->error;
    }
}

//search a admin.
if (isset($_POST['search'])) {
    $id = $_POST['id'];

    // Prepare the SQL statement to search for a admin by ID
    $stmt = $conn->prepare("SELECT * FROM admin WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <title>MedEase</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>MedEase Administrator</h1>

    <div class="container">
        <div class="form-section">
            <h2>Add Admin:</h2>
            <form action="" method="POST">
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" required><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" required><br>    
                <label for="DOE">Date:</label><br>
                <input type="date" name="DOE" id="DOE" required><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required><br>
                <label for="pnumber">Phone Number:</label><br>
                <input type="number" name="pnumber" id="pnumber" required><br>
                <label for="salary">Salary:</label><br>
                <input type="text" name="salary" id="salary" placeholder="$200,000" required><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required><br>
                <br>
                <input type="submit" name="add" value="Add Admin">
            </form>
        </div>

        <div class="form-section">
            <h2>Edit Admin:</h2>
            <form action="" method="POST">
                <label for="id">Admin ID:</label><br>
                <input type="text" name="id" id="id" required><br>
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" required><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" required><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email"><br>
                <label for="pnumber">Phone Number:</label><br>
                <input type="number" name="pnumber" id="pnumber"><br>
                <label for="salary">Salary:</label><br>
                <input type="text" name="salary" id="salary" placeholder="$200,000"><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password"><br>
                <br>
                <input type="submit" name="edit" value="Edit Admin">
            </form>
        </div>

        <div class="form-section">
            <h2>Delete Admin:</h2>
            <form action="" method="POST">
                <label for="id">admin ID:</label><br>
                <input type="text" name="id" id="id" required><br>
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" required><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" required><br>
                <br>
                <input type="submit" name="delete" value="Delete Admin">
            </form>
        </div>
        
        <div class="form-section">
            <h2>Search Admin:</h2>
            <form action="" method="POST">
                <label for="id">ID</label><br>
                <input type="number" name="id" id="id"><br>
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" value="<?php echo isset($admin) ? $admin['fname'] : ''; ?>"><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" value="<?php echo isset($admin) ? $admin['lname'] : ''; ?>"><br>
                <label for="DOE">Date of Employment:</label><br>
                <input type="date" name="DOE" id="DOE" value="<?php echo isset($admin) ? $admin['DOE'] : ''; ?>"><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" value="<?php echo isset($admin) ? $admin['email'] : ''; ?>"><br>
                <label for="pnumber">Phone Number:</label><br>
                <input type="number" name="pnumber" id="pnumber" value="<?php echo isset($admin) ? $admin['pnumber'] : ''; ?>"><br>
                <label for="salary">Salary:</label><br>
                <input type="text" name="salary" id="salary" value="<?php echo isset($admin) ? $admin['salary'] : ''; ?>"><br>
                <br>
                <input type="submit" name="search" value="Search Admin">
            </form>
        </div>
    </div>
</body>
</html>
