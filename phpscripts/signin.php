<?php
// Start the session
session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$db_password = "";
$database = "proiectewd";

$conn = new mysqli($servername, $username, $db_password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the email and password from the submitted form
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare a SQL statement to fetch the user with the provided email
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user is found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify the provided password against the stored hashed password
    if (password_verify($password, $row['password'])) {
        // Set session variables to store the user information
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];

        // Redirect to the homepage
        header("Location: ../index.php");
    } else {
        // Invalid password
        echo "Incorrect password. Please try again.";
    }
} else {
    // No user found
    echo "No user found with this email address.";
}

// Close the connection
$conn->close();
?>