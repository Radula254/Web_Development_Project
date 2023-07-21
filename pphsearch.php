<?php
    // Include the data.php file for the database connection
    require_once 'data.php';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];

        // Prepare and execute the SQL statement to select data with the given fname and lname
        $stmt = $conn->prepare("SELECT * FROM appointment WHERE fname = ? AND lname = ?");
        $stmt->bind_param("ss", $firstName, $lastName);
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Display the search results in a table
        if ($result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table>";
            echo "<tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th class='spaced-words'>Prescriptions</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['fname']."</td>";
                echo "<td>".$row['lname']."</td>";
                echo "<td>".$row['age']."</td>";
                echo "<td>".$row['prescriptions']."</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No matching records found.</p>";
        }

        // Close the statement
        $stmt->close();
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="display.css">

    <style>
        #search  {
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

        #search:hover {
            background-color: #088178;
        }
    </style>
</head>
<body>
    <button id="search" onclick="goBack()">Back</button>

    <script>
        // JavaScript function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>