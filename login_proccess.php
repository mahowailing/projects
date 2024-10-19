<?php
session_start();
include 'connect.php'; // Ensure this path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, $sql);

        if ($result === false) {
            die('Query failed: ' . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 1) {
            // $row = mysqli_fetch_assoc($result);
                echo "Login Succesfully";
                // Redirect to dashboard
                // header("Location: studentdashh.php");
                exit();
            }
        else{
            echo "Wrong Password";
        }
?>
