<?php
// Include your database connection code (data.php)
require_once('data.php');

// Check if a drug ID is provided 
if (isset($_GET['id'])) {
    $drugID = $_GET['id'];

    // Query to fetch drug details based on drug ID
    $sql = "SELECT * FROM images WHERE id = $drugID"; // Adjust this query as needed

    $result = $conn->query($sql);

    // Check if there is a matching drug
    if ($result->num_rows > 0) {
        // Start HTML output
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="drugdetails.css">
            <link rel="stylesheet" href="admin4.css">
            <link rel="stylesheet" href="index.css">
            <link rel="icon" type="image/jpg" href="logo6.jpg">
            <title>MedEase</title>
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

            
            <section id="textarea">
                <div class="area">
                    <h1 style="text-decoration: underline;">Details concerning Drug:</h1>
                    <?php
                        
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<div id='img_div'>";
                                echo "<img src='images/".$row['images']."' >";
                                echo "<p>".$row['drugName']."</p>";
                                echo "<p>".$row['drugDetails']."</p>";
                            echo "</div>";
                        }
                    ?>
                    <button onclick="goBack()">Go Back</button>

                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                </div>
            </section>
<!---
    <footer class="section-p1">
        <div class="col">
            <img src="logo2.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong>489 Kitusuri Road, Street 77, Nairobi</p>
            <p><strong>Phone: </strong> +254 797 093 831 /(020) 01 1436 1483</p>
            <p><strong>Hours: </strong> 24/7, Including Holidays</p>
            <a href="index.html">Home</a>
            <a href="index.html">Services</a>
            <a href="index.html">About</a>
            <div class="follow">
                <h4>Follow us:</h4>
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
<?php
    } else {
        echo "Drug not found.";
    }
} else {
    echo "Drug ID not provided.";
}

// Close the database connection
$conn->close();
?>