<?php
session_start();

// Unset or destroy the session variables
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect the user to the index or login page after logout
header("Location: index.php"); // Redirect to the desired page
exit; // Ensure that no further code is executed after the redirect
?>
