<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="sign.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form id="signup-form" method="POST" action="register.php" onsubmit="return validateBeforeSubmit()">
            <label for="name">Name:</label><br>
            <input type="text" name="name" id="name" placeholder="Enter your name" required><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" placeholder="Enter your email" required><br>

            <label for="password">Password:</label><br>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
            </div>

            <ul class="password-requirements" id="password-requirements">
                <li id="length-check" class="invalid"><span class="icon">⚫</span> At least 8 characters length</li>
                <li id="uppercase-check" class="invalid"><span class="icon">⚫</span> At least 1 uppercase letter (A...Z)</li>
                <li id="number-check" class="invalid"><span class="icon">⚫</span> At least 1 number (0...9)</li>
                <li id="special-char-check" class="invalid"><span class="icon">⚫</span> At least 1 special symbol (!...$)</li>
            </ul>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required><br>
            <span id="mismatch-warning" class="mismatch-warning">Passwords do not match!</span>

            <button id="submit-btn" type="submit">Sign Up</button><br><br>
        </form>

        <p>Already have an account? <a href="index.php">Sign in here</a></p>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const passwordRequirements = document.getElementById('password-requirements');
        const mismatchWarning = document.getElementById('mismatch-warning');
        const submitButton = document.getElementById('submit-btn');

        function validatePassword() {
            const password = passwordInput.value;

            const lengthCheck = /.{8,}/;
            const uppercaseCheck = /[A-Z]/;
            const numberCheck = /[0-9]/;
            const specialCharCheck = /[\W_]/;

            updateFeedback('length-check', lengthCheck.test(password));
            updateFeedback('uppercase-check', uppercaseCheck.test(password));
            updateFeedback('number-check', numberCheck.test(password));
            updateFeedback('special-char-check', specialCharCheck.test(password));

            validatePasswordMatch();

            const allValid = lengthCheck.test(password) &&
                            uppercaseCheck.test(password) &&
                            numberCheck.test(password) &&
                            specialCharCheck.test(password);

            return allValid;
        }

        function validatePasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (password !== confirmPassword && confirmPassword !== "") {
                mismatchWarning.style.display = 'block';
            } else {
                mismatchWarning.style.display = 'none';
            }
        }

        function updateFeedback(elementId, isValid) {
            const element = document.getElementById(elementId);
            if (isValid) {
                element.classList.add('valid');
                element.classList.remove('invalid');
                element.querySelector('.icon').textContent = '✔️';
            } else {
                element.classList.add('invalid');
                element.classList.remove('valid');
                element.querySelector('.icon').textContent = '⚫';
            }
        }

        passwordInput.addEventListener('focus', () => {
            passwordRequirements.classList.add('active');
        });

        document.querySelectorAll('input').forEach(inputField => {
            inputField.addEventListener('focus', (e) => {
                if (e.target !== passwordInput) {
                    passwordRequirements.classList.remove('active');
                }
            });
        });

        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePasswordMatch);

        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const passwordFieldType = passwordField.getAttribute('type');
            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
            } else {
                passwordField.setAttribute('type', 'password');
            }
        }

        // This ensures that validation is performed just before the form is submitted.
        function validateBeforeSubmit() {
            const passwordsMatch = passwordInput.value === confirmPasswordInput.value;
            const validPassword = validatePassword();

            if (!validPassword || !passwordsMatch) {
                return false; // Prevent form submission if validation fails
            }

            return true; // Allow form submission if everything is valid
        }
    </script>
</html>