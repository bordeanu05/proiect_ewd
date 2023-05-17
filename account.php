<!DOCTYPE html>
<html>

<?php session_start(); ?>

<head>
	<title>Your account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="navbar">
        <div class="logo">Internship Finder</div>

        <ul class="nav_links">
            <div class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>

                <li class="account">
                    <a href="account.php">Account</a>

                    <ul class="account_dropdown">
                        <?php
                            if (isset($_SESSION['user_id'])) {
                                echo '<li><a href="phpscripts/signout.php">Sign out</a></li>';
                            } else {
                                echo '<li><a href="login.php">Sign in</a></li>';
                                echo '<li><a href="register.php">Sign up</a></li>';
                            }
                        ?>
                    </ul>
                </li>

                <li><a href="contact.php">Contact</a></li>
            </div>
        </ul>
    </div>

    <div>
        <div class="title">Your favorite internships</div>
    </div>

    <div class="index_container">
        <?php
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                // Set up a connection to your database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "proiectewd";

                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Create a SQL query to fetch the user's favorite internships
                $sql = "SELECT internships.* FROM internships
                        INNER JOIN favorites ON internships.id = favorites.internship_id
                        WHERE favorites.user_id = ?";

                // Execute the SQL query and fetch the results
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display the results on your webpage using HTML and PHP
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='list_item_container'>";
                        echo "<div class='list_item'>";
                        echo "<div><span class='list_item_label'>Title:</span> <span class='list_item_value'>" . $row["title"] . "</span></div>";
                        echo "<div><span class='list_item_label'>Requirements:</span> <span class='list_item_value'>" . $row["requirements"] . "</span></div>";
                        echo "<div><span class='list_item_label'>Company:</span> <span class='list_item_value'>" . $row["company"] . "</span></div>";
                        echo "<div><span class='list_item_label'>Start Date:</span> <span class='list_item_value'>" . $row["startdate"] . "</span></div>";
                        echo "<div><span class='list_item_label'>End Date:</span> <span class='list_item_value'>" . $row["enddate"] . "</span></div>";
                        echo "<button class='remove-button' data-internship-id='" . $row["id"] . "'>Remove</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>You have no favorite internships yet.</p>";
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "<p>Please <a href='login.php'>sign in</a> to view your favorite internships.</p>";
            }
        ?>
    </div>

    <script>
        $(document).ready(function() {
            $(".remove-button").on("click", function() {
                let internshipId = $(this).data("internship-id");
                let userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;
                $.ajax({
                    url: "phpscripts/removefavorite.php",
                    type: "POST",
                    data: {
                        user_id: userId,
                        internship_id: internshipId
                    },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(response) {
                        alert(response);
                    }
                });
            });
        });
    </script>

</body>

</html>