<?php
// Database configuration
$servername = "localhost"; // or your database server
$username = "root";        // your database username
$password = "";            // your database password
$dbname = "your_database"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all data from the 'students' table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Name: " . $row["name"]. " - Age: " . $row["age"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
