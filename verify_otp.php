<?php
session_start();
include 'connect.php'; // Ensure your database connection is included

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the OTP entered by the user
    $enteredOtp = $_POST['otp'];

    // Check if the OTP exists in the session
    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiration'])) {
        $storedOtp = $_SESSION['otp'];
        $expirationTime = $_SESSION['otp_expiration'];

        // Check if the OTP is still valid
        if (time() < $expirationTime) {
            // Compare the entered OTP with the stored OTP
            if ($enteredOtp === $storedOtp) {
                // OTP is valid
                echo "<script>alert('OTP verified successfully! You can proceed.');</script>";
                header("Location: landingpage.html");
                exit();
            } else {
                // Invalid OTP
                echo "Invalid OTP. Please try again.";
            }
        } else {
            // OTP has expired
            echo "OTP has expired. Please request a new one.";
            unset($_SESSION['otp']); // Clear OTP from session
            unset($_SESSION['otp_expiration']); // Clear expiration from session
        }
    } else {
        // No OTP session available
        echo "No OTP session found. Please request a new OTP.";
    }
}
?>