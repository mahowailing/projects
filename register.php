<?php
include 'connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
}

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }


    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('New user registered successfully!');</script>";
        header("Location: index.php");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con) . "');</script>";
    }

mysqli_close($con);
?>
