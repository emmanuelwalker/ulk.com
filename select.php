<?php
// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ulk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $admin_username = trim($_POST['username']);
    $admin_password = trim($_POST['password']);

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $admin_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($admin_password, $hashed_password)) {
            echo "Login successful. Welcome, " . htmlspecialchars($admin_username) . "!";
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No user found with the given username. Please check your details.";
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>


       
        
            
       

