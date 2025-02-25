<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multi"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Successful login, redirect to index page
            header("Location: index1.html");
            exit();
        } else {
            // Incorrect password, redirect back with error message
            header("Location: login.html?error=Incorrect password. Please try again.");
            exit();
        }
    } else {
        // User not found, redirect back with error message
        header("Location: login.html?error=No account found with that email. Please register.");
        exit();
    }
}

$conn->close();
?>
