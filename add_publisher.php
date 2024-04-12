<?php
session_start(); 
include 'db_connection.php'; // Include database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $publisherName = $_POST['publisherName'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO Publishers (PublisherName) VALUES (?)");
    $stmt->bind_param("s", $publisherName);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the page with a success message
        header("Location: a_publisher.php?message=success");
        exit();
    } else {
        // Redirect to the page with an error message
        header("Location: a_publisher.php?message=error");
        exit();
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
