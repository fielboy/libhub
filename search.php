<?php
// Include your database connection file
include 'db_connection.php';

// Define table headers
$tableHeaders = ["Title", "Author", "Publisher", "Copyright", "Subject Area", "Key Stage", "Source", "Format", "Classification No", "Book ID", "Status"];

// Check if search query parameter is set
if(isset($_GET['search'])) {
    // Sanitize the search query to prevent SQL injection
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    
    // Construct the SQL query to search for books
    $sql = "SELECT * FROM books WHERE TITLE LIKE '%$search%' OR AUTHOR LIKE '%$search%' OR PUBLISHER LIKE '%$search%' OR COPYRIGHT LIKE '%$search%' OR SUBJECT_AREA LIKE '%$search%' OR KEY_STAGE LIKE '%$search%' OR SOURCE LIKE '%$search%' OR FORMAT LIKE '%$search%' OR CLASSIFICATION_NO LIKE '%$search%' OR ISBN LIKE '%$search%' OR DATE_RECEIVED LIKE '%$search%' OR STATUS LIKE '%$search%'";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if ($result && mysqli_num_rows($result) > 0) {
        // Display table headers
        echo "<tr>";
        foreach ($tableHeaders as $header) {
            echo "<th>$header</th>";
        }
        echo "</tr>";

        // Fetch rows from the result set and construct HTML content for table rows
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['TITLE']."</td>";
            echo "<td>".$row['AUTHOR']."</td>"; 
            echo "<td>".$row['PUBLISHER']."</td>"; 
            echo "<td>".$row['COPYRIGHT']."</td>";
            echo "<td>".$row['SUBJECT_AREA']."</td>";
            echo "<td>".$row['KEY_STAGE']."</td>";
            echo "<td>".$row['SOURCE']."</td>";
            echo "<td>".$row['FORMAT']."</td>";
            echo "<td>".$row['CLASSIFICATION_NO']."</td>";
            echo "<td>".$row['bookID']."</td>";
            echo "<td>".$row['STATUS']."</td>";
            echo "</tr>";   
        }
    } else {
        echo "<tr><td colspan='13'>No books found</td></tr>";
    }
} else {
    // If no search query parameter is provided, display a message
    echo "<tr><td colspan='13'>Please enter a search query</td></tr>";
}

mysqli_close($conn);
?>
