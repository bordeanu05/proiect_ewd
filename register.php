<!DOCTYPE html>
<html>

<head>
	<title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
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
                            session_start();
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

    <div class="login">
        <div class="login_title">Sign up</div>

        <form action="phpscripts/signup.php" method="post">
            <div class="login_fields">
                <div class="login_fields_user">
                    <input placeholder="Email" type="email" name="email" required>
                </div>

                <div class="login_fields_password">
                    <input placeholder="Password" type="password" name="password" required>
                </div>

                <div class="login_fields_submit">
                    <input type="submit" value="Sign up">
                </div>
            </div>
        </form>
    </div>

</body>

</html>