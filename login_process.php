<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Use a prepared statement to avoid SQL injection
        $sql = "SELECT * FROM users WHERE email LIKE '%$email%'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
        
            // Check if the password matches (assuming the password is not hashed)
            if ($user['password'] === $password) {
                // Store only user ID or email in the session
                $_SESSION['user'] = $user['id']; // Store the user ID in session
        
                // Redirect to OTP verification page
                header("Location: otp_verification.php");
                exit(); // Stop further execution after redirect
            } else {
                echo '<script>
                        alert("Incorrect Password!");
                        window.location.href = "index.php";
                      </script>';
                exit(); // Stop further execution
            }
        } else {
            echo '<script>
                    alert("Email not Found!");
                    window.location.href = "index.php";
                  </script>';
            exit(); // Stop further execution
        }
        
    }
}
?>
