<?php
session_start();
include 'connect.php'; // Ensure your database connection is included
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  

// Function to generate OTP
function generateOTP($length = 6) {
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= random_int(0, 9);
    }
    return $otp;
}

function sendOTPEmail($email, $otp) {
    $subject = "Your OTP Code";
    $message = "Your OTP code is: <strong>$otp</strong>. It will expire in 10 minutes.";
    $senderEmail = 'your-email@yourdomain.com'; // Replace with your sender email
    $senderName = 'Activity1'; // Replace with your sender name

    // Using PHPMailer to send OTP to email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = ''; // Update with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = ''; // Update with your SMTP username
        $mail->Password = ''; // Update with your SMTP password
        $mail->SMTPSecure = 'ssl'; // Use TLS encryption
        $mail->Port = 465; // Use the appropriate port

        // Recipients
        $mail->setFrom($senderEmail, $senderName);
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true; // Success
    } catch (Exception $e) {
        return false; // Failure
    }
}

// Handle AJAX request to send OTP
if (isset($_POST['send_otp'])) {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];

        // Fetch the user's email from the database
        $query = "SELECT email FROM users WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $otp = generateOTP();  // Generate OTP

            // Save OTP in session with an expiration time (e.g., 10 minutes)
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_expiration'] = time() + 600;  // OTP valid for 10 minutes

            // Send OTP to user's email
            if (sendOTPEmail($user['email'], $otp)) {
                echo "OTP sent successfully.";
            } else {
                echo "Failed to send OTP.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "You must be logged in to request an OTP.";
    }
    exit; // Exit to prevent further output
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <link rel="stylesheet" href="otp.css">
    <script>
        function sendOtp(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Create an AJAX request to send OTP
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true); // Send to the same file
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Show server response
                } else {
                    alert('Error sending OTP: ' + xhr.responseText);
                }
            };

            // Send the request to send OTP
            xhr.send('send_otp=true'); // Include the required data in the request
        }
    </script>
</head>
<body>
    <div class="container">
    <h2>OTP Verification</h2>
    <form method="POST" action="verify_otp.php">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Verify OTP</button><br><br>
    </form>

    <button onclick="sendOtp(event)">Send OTP</button> <!-- Button to send OTP -->
</body>
</html>
