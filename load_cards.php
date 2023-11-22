<?php
include 'data.php'; // Include your database connection details here

$data = array();

// Retrieve data from the database
$query = "SELECT image_url, card_text FROM cards";
$result = $connection->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data['cards'][] = $row;
    }
    $result->free_result();
} else {
    $data['error'] = 'Error retrieving data from the database: ' . $connection->error;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
