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
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($con) . "');</script>";
    }
    

// 8. Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <div class="container">
        <div class="image-section">
            <img src="blue.jpeg" alt="Sign In Image">
        </div>
        <div class="form-section">
            <h1>Sign In</h1>
            <form action="login_process.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Sign In</button>
            </form>
            <div class="signup-redirect">
                <p>Don't have an account yet? <a href="signup.php">Sign up here</a> </p>
            </div>
        </div>
    </div>
</body>
</html>