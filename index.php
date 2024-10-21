<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="signin.css">

    <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="image-section">
            <img src="image1_0.jpg" alt="Sign In Image">
        </div>
        <div class="form-section">
            <h1>Sign In</h1>
            <form action="login_process.php" method="POST">
                <label for="email" style="font-size: 14px;"><b>Email</b></label>
                <input type="email" id="email" name="email" required>

                <label for="password" style="font-size: 14px;"><b>Password</b></label>
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
