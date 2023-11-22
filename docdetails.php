<?php
require_once('data.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $docName = $_POST["docName"];
    $docDetails = $_POST["docDetails"];

    //Insert into database
    $sql = "INSERT INTO docdetails(docName, docDetails) VALUES (?,?)";
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("ss", $docName , $docDetails);

        if($stmt->execute()) {
            header("docdetails.html");
            exit();
        }else {
            echo "Error" . $stmt->error;
        }
        $stmt->close();
    } else{
         echo "Error: " . $conn->error;
    }
}

//close connection
$conn->close();
?>