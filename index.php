<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to Our Website</h2>
        <div id="loginForm" class="form-container active">
            <h3>Login</h3>
            <form method="post" action="assets/db/login.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="#" onclick="showForm('register')">Register here</a></p>
        </div>

        <div id="registerForm" class="form-container">
            <h3>Register</h3>
            <form method="post" action="assets/db/register.php">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="date" name="birthday" required>
                <input type="number" name="age" placeholder="Age" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="#" onclick="showForm('login')">Login here</a></p>
        </div>
    </div>
    <script src="assets/scripts.js"></script>
</body>
</html>
