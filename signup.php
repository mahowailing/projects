<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="sign.css">
    <!-- <style>
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: darkblue;
        }
    </style> -->
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form method="POST" action="register.php">
            <label for="name">Name:</label><br>
            <input type="text" name="name" id="name" placeholder="Enter your name" required><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" placeholder="Enter your email" required><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" placeholder="Enter your password" required><br>
            <!-- Password Rules -->
            <span id="length-check" style="color:red; display: none;">Must be 8 characters</span>
            <span id="uppercase-check" style="color:red; display: none;">Must have 1 uppercase letter</span>
            <span id="number-check" style="color:red; display: none;">Must have 1 number</span>
            <span id="special-char-check" style="color:red; display: none;">Must have 1 special character</span>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required><br>

            <button id="submit-btn" type="submit" disabled>Sign Up</button>
        </form>

        <p>Already have an account? <a href="index.php">Sign in here</a></p>

    </div>
</body>

    <script>
            function validatePassword() {
            const password = document.getElementById('password').value;

            // Define your regex parameters for each rule
            const lengthCheck = /.{8,}/;
            const uppercaseCheck = /[A-Z]/;
            const numberCheck = /[0-9]/;
            const specialCharCheck = /[\W_]/;

            // Check each rule and update the corresponding DOM elements
            updateFeedback('length-check', lengthCheck.test(password));
            updateFeedback('uppercase-check', uppercaseCheck.test(password));
            updateFeedback('number-check', numberCheck.test(password));
            updateFeedback('special-char-check', specialCharCheck.test(password));

            // Enable or disable submit button based on whether all checks are true
            const allValid = lengthCheck.test(password) && 
                            uppercaseCheck.test(password) && 
                            numberCheck.test(password) && 
                            specialCharCheck.test(password);

            document.getElementById('submit-btn').disabled = !allValid;
        }

        // Helper function to update the color of the feedback text
        function updateFeedback(elementId, isValid) {
            document.getElementById(elementId).style.display = isValid ? 'none' : 'block';
        }

        function showPasswordRules() {
        document.getElementById('length-check').style.display = 'block';
        document.getElementById('uppercase-check').style.display = 'block';
        document.getElementById('number-check').style.display = 'block';
        document.getElementById('special-char-check').style.display = 'block';
}

        // Add event listener to password input for real-time validation
        document.getElementById('password').addEventListener('input', validatePassword);

        // Add event listener to show the rules once user starts typing
        document.getElementById('password').addEventListener('keydown', showPasswordRules);
    </script>
</html>