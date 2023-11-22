<?php
if (isset($_POST['upload'])) {
    //The path to store the uploaded image
    $target = "images/".basename($_FILES['image']['name']);

    //connect to the database
    $db = mysqli_connect("localhost", "root" , "" , "medease");

    //Get all the submitted data from the form
    $image = $_FILES['image']['name'];
    $drugName = $_POST["drugName"];
    $drugDetails = $_POST["drugDetails"];
    

    $sql = "INSERT INTO images (images, drugName, drugDetails) VALUES ('$image' , '$drugName', '$drugDetails')";
    mysqli_query($db, $sql);//stores the submitted data into the database table: images

    //move the uploaded images into the folder: images
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
        header("Location: ddetails.html"); // Redirect to the drug details page
        exit();
    }else{
        $msg = "There was a problem";
    }

}

?>