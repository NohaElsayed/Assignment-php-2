<?php
// Start session to access and store user data
session_start();

// Array to collect validation error messages
$errors = [];

// Check if user is logged in (email exists in session)
$isLoggedIn = isset($_SESSION['email']);

// ==================== FORM SUBMISSION HANDLER ====================
// Only process when form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ==================== LOGIN FORM (User NOT logged in) ====================
    if (!$isLoggedIn) {
        // Get and clean email input (remove whitespace from start/end)
        $email    = trim($_POST['email']    ?? '');
        // Get and clean password input
        $password = trim($_POST['password'] ?? '');

        // Validate email: required + valid format
        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }

        // Validate password: required + minimum 6 characters
        if (empty($password)) {
            $errors[] = "Password is required.";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        // If no errors, save to session and redirect to account page
        if (empty($errors)) {
            $_SESSION['email']    = $email;    // Store email in session
            $_SESSION['password'] = $password; // Store password in session
            header("Location: account.php");  // Redirect to profile form
            exit(); // Stop script execution after redirect
        }

        // ==================== PROFILE FORM (User IS logged in) ====================
    } else {
        // Get and clean all profile fields
        $username  = trim($_POST['username']  ?? '');
        $password  = trim($_POST['password']  ?? '');
        $email     = trim($_POST['email']     ?? '');
        $phone     = trim($_POST['phone']     ?? '');
        $facebook  = trim($_POST['facebook']  ?? '');
        $twitter   = trim($_POST['twitter']   ?? '');
        $instagram = trim($_POST['instagram'] ?? '');

        // ----- Username Validation -----
        if (empty($username)) {
            $errors[] = "Username is required.";
        } elseif (strlen($username) < 3) {
            $errors[] = "Username must be at least 3 characters.";
        }

        // ----- Password Validation -----
        if (empty($password)) {
            $errors[] = "Password is required.";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        // ----- Email Validation -----
        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }

        // ----- Phone Validation (Egyptian format) -----
        // Must start with 010, 011, or 012 and be exactly 11 digits
        if (empty($phone)) {
            $errors[] = "Phone number is required.";
        } elseif (!preg_match('/^01[012][0-9]{8}$/', $phone)) {
            $errors[] = "Phone must start with 010, 011, or 012 and be 11 digits.";
        }

        // ----- Social URLs Validation (Optional fields) -----
        // Only validate if field is not empty
        if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
            $errors[] = "Please enter a valid Facebook URL.";
        }
        if (!empty($twitter) && !filter_var($twitter, FILTER_VALIDATE_URL)) {
            $errors[] = "Please enter a valid Twitter URL.";
        }
        if (!empty($instagram) && !filter_var($instagram, FILTER_VALIDATE_URL)) {
            $errors[] = "Please enter a valid Instagram URL.";
        }

        // ----- Save Data if No Errors -----
        if (empty($errors)) {
            // Store all profile data in session
            $_SESSION['username']  = $username;
            $_SESSION['password']  = $password;
            $_SESSION['email']     = $email;
            $_SESSION['phone']     = $phone;
            $_SESSION['facebook']  = $facebook;
            $_SESSION['twitter']   = $twitter;
            $_SESSION['instagram'] = $instagram;

            // Redirect to home page after successful save
            header("Location: index.php");
            exit(); // Stop script execution
        }
    }
}
