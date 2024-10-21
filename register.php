<?php
include 'connect.php';

// 2. Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 3. Get the form data from POST request
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
}

    // 4. Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }


    // 6. Prepare the SQL query to insert the user data
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    // 7. Execute the query and check if the insertion was successful
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('New user registered successfully!');</script>";
        header("location: index.php");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con) . "');</script>";
    }
    

// 8. Close the database connection
mysqli_close($con);
?>