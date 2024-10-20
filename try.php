<?php
session_start();
require 'vendor/autoload.php';  // Include PHPMailer

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
    $message = "Your OTP code is: $otp. It will expire in 10 minutes.";
    $headers = "From: no-reply@yourdomain.com";

    // Using PHPMailer to send OTP to email
    $mail = new PHPMailer(true);
    try {
            $mail->isSMTP();
            $mail->Host = 'in-v3.mailjet.com'; // Mailjet SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'b563129b60700b10ec8c653e20b1697b'; // Mailjet API Key
            $mail->Password = '5fcca40e9a0eeae5eec2939908eedd66'; // Mailjet API Secret
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; // Mailjet SMTP port                             // TCP port

        // Recipients
        $mail->setFrom('mattquiling@gmail.com', 'try');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo "OTP sent to email.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
    
    // Fetch the user's email from the database
    $query = "SELECT email FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $otp = generateOTP();  // Generate OTP
    
    // Save OTP in session with an expiration time (e.g., 10 minutes)
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_expiration'] = time() + 600;  // OTP valid for 10 minutes
    
    sendOTPEmail($user['email'], $otp);  // Send OTP to user's email
}
?>
