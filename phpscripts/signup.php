<?php
// Get the submitted form data
$email = $_POST['email'];
$password = $_POST['password'];

// Connect to the database
$servername = "localhost";
$username = "root";
$db_password = "";
$database = "proiectewd";

$conn = new mysqli($servername, $username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email already exists
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Email already exists. Please choose a different email.";
    exit;
}

// Insert the new user into the 'users' table
$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password before storing it
$stmt->bind_param("ss", $email, $hashed_password);

if ($stmt->execute()) {
    echo "User registered successfully!";
    // Redirect to the login page
    header("Location: ../login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>