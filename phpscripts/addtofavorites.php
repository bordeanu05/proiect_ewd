<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proiectewd";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_POST["user_id"];
    $internship_id = $_POST["internship_id"];

    // Check if the user has already added this internship as a favorite
    $check_sql = "SELECT * FROM favorites WHERE user_id = ? AND internship_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $user_id, $internship_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "This internship is already in your favorites.";
    } else {
        $sql = "INSERT INTO favorites (user_id, internship_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $internship_id);

        if ($stmt->execute()) {
            echo "Favorite added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
?>