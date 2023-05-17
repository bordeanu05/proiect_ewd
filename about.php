<!DOCTYPE html>
<html>

<head>
	<title>About us</title>
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

    <main>

        <div class="bigContainer">
            <div class="container">
                <div class="title">Who are we? 🤔</div>

                <div class="about">
                    <p> 
                        We are a passionate group of students from the Faculty of Mathematics and Computer Science 
                        at the prestigious West University of Timisoara. Our shared vision is to assist fellow students
                        in discovering the perfect internship opportunity that matches their interests and skills. 
                    </p> <br>

                    <p>
                        We understand that finding the right internship can be a daunting task, which is why 
                        we have taken it upon ourselves to alleviate this stress for our peers. As students ourselves,
                        we have gone through the process of searching for internships and recognize the difficulties that arise along the way. 🚀
                    </p> <br>
                </div>
            </div>

            <div class="container">
                <div class="title">Why do we do this?</div>

                <div class="about">
                    <p>
                        We believe that internships are an essential part of the university experience. 
                        They provide students with the opportunity to apply their knowledge in a real-world setting,
                        gain valuable experience, and develop their professional skills. 💼
                    </p> <br>

                    <p>
                        We also believe that internships are a great way for companies to discover talented students
                        and potential future employees. 🌟
                    </p> <br>
                </div>
            </div>
        </div>

    </main>

</body>

</html>