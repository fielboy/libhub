<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorName = $_POST['authorName'];

    // Prepare the SQL statement to insert data into the Authors table
    $sql = "INSERT INTO Authors (AuthorName,  CreatedDate) VALUES (?, NOW())";

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $authorName);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        // Redirect back to the page with a success message
        header("Location: a_author.php?message=success");
        exit();
    } else {
        // Redirect back to the page with an error message
        header("Location: a_author.php?message=error");
        exit();
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
