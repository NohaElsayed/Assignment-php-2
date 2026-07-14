<?php
// Start session to access session data
session_start();

// Destroy all session data (logs user out completely)
session_destroy();

// Redirect to home page after logout
header("Location: index.php");

// Stop script execution
exit();
