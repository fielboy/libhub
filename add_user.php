<?php
session_start(); 
include 'db_connection.php'; // Include database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    if(isset($_POST['fullName'], $_POST['email'], $_POST['contactNo'], $_POST['role'], $_POST['password'])){
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $contactNo = $_POST['contactNo'];
        $role = $_POST['role'];
        $password = $_POST['password'];

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO u_management (FULLNAME, EMAIL, CONTACT_NO, ROLE, PASSWORD) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullName, $email, $contactNo, $role, $password);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the page with a success message
            header("Location: a_user.php?message=success");
            exit();
        } else {
            // Redirect to the page with an error message
            header("Location: a_user.php?message=error");
            exit();
        }

        // Close statement
        $stmt->close();
    } else {
        // Handle missing form fields
        header("Location: a_user.php?message=error&error=missing_fields");
        exit();
    }
}

// Close connection
$conn->close();
?>
