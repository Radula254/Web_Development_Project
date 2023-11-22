<php
  require_once('data.php');
if(isset($_POST["submit"])){
    $name = $_POST["name"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <link rel="stylesheet" href="details.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

    <title>MedEase</title>
    
</head>
<body>
    <div class="title">
        <h1>MedEase</h1>
    </div>
    <div class="form1">
        <form action="ddetails.php" method="post" enctype="multipart/form-data">
            
            <label for="drugName">Drug Name:</label><br>
            <input type="text" name="drugName" required><br>
    
            
            <input type="file" name="image"><br>

            <input type="submit" value="Submit">
            
            
        </form>
        <button onclick="goback()" class="normal"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>Return</button>

            <script>
                function goback(){
                    window.history.back();
                }
            </script>
    </div>
</body>
</html>