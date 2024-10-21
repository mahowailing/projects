<?php
session_start();
include 'connect.php';
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
            $message = "Your OTP code is: $otp. It will expire in 10 minutes.";
            $headers = "From: no-reply@yourdomain.com";

            // Using PHPMailer to send OTP to email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                 $mail->Host = 'smtp.gmail.com';
                 $mail->SMTPAuth = true;
                 $mail->Username = 'waay.dicta@gmail.com';
                 $mail->Password = 'sszd dveb sufk kwum';
                 $mail->SMTPSecure = 'ssl';
                 $mail->Port = 465; 

                // Recipients
                $mail->setFrom('your-email@yourdomain.com', 'Activity1');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                echo "<script>alert('OTP sent to email.');</script>";
                
            } catch (Exception $e) {
                echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
            }
        }

        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user'];
            
            // Fetch the user's email from the database
            $query = "SELECT email FROM users WHERE id = ?";
            $stmt = $con->prepare($query);
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
