<?php
// Include your database connection code (data.php)
require_once('data.php');

// Check if a doc ID is provided 
if (isset($_GET['id'])) {
    $docID = $_GET['id'];

    // Query to fetch doc details based on doc ID
    $sql = "SELECT docName, docDetails FROM docdetails WHERE id = $docID"; // Adjust this query as needed

    $result = $conn->query($sql);

    // Check if there is a matching doc
    if ($result->num_rows > 0) {
        // Start HTML output
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="docdetails.css">
            <link rel="stylesheet" href="index.css">
             <title>MedEase</title>
        </head>
        <body>
            <section id="header">
            <a href="#"><img src="logo7.jpg" class="logo" alt=""></a>

            <div>
                <ul id="navbar">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="services.html">Servises</a></li>
                    <li><a href="about.html">About</a></li>
                    <a href="#" id="close"><i class="fa fa-times" aria-hidden="true"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <i id="bar" class="fas fa-outdent"></i>
            </div>
            </section>
            <section id="textarea">
                <div class="area">
                    <h1 style="text-decoration: underline;">Details concerning doc:</h1>
                    <?php
                    // Display doc details
                    $row = $result->fetch_assoc();
                    echo '<h3 style="padding: 10px;">';
                    echo '<strong>Doc Name:</strong> ' . $row['docName'] . '<br><br>';
                    echo '<strong>Details:</strong> ' . $row['docDetails'];
                    echo '</h3>';
                    ?>
                    <button onclick="goBack()">Go Back</button>

                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                </div>
            </section>

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

</body>
</html>
<?php
    } else {
        echo "doc not found.";
    }
} else {
    echo "doc ID not provided.";
}

// Close the database connection
$conn->close();
?>