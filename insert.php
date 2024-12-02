<?php
// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ulk";  // Ensure this is the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['username'];      // Full Name
    $email = $_POST['email'];        // Email Address
    $password = $_POST['password'];  // Password
    $dob = $_POST['dob'];            // Date of Birth
    $course = $_POST['course'];      // Selected Course
    $address = $_POST['address'];    // Address
    $phone = $_POST['phone'];        // Phone Number

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO students_detail (username, email, password, dob, course, address, phone) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $hashed_password, $dob, $course, $address, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Application submitted successfully!<br> Registary will massage you soon');</script>";
        header('location:menu.html');
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
