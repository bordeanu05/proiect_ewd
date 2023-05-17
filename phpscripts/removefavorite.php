<?php
    session_start();

    $user_id = $_SESSION['user_id'];
    $internship_id = $_POST['internship_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proiectewd";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM favorites WHERE user_id = ? AND internship_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $internship_id);

    if ($stmt->execute()) {
        echo "Favorite removed successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>