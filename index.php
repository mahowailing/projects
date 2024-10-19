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
