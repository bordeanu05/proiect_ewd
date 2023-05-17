<?php
// Start the session
session_start();

// Unset all the session variables related to the user
unset($_SESSION['user_id']);
unset($_SESSION['user_email']);

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other page you prefer
header("Location: ../login.php");
exit;
?>