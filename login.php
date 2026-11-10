<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Styles/initialStyle.css">
</head>

<body>
    <main class="login-card">
        <form action="login.php" method="POST" class="form-options">
            <label for="username" class="form-options label">Name:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="email" class="form-options label">E-mail:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="password" class="form-options label">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <button type="submit" class="btn-login">Enter</button>
            <p>Don't have an account? <a href="signup.php" class="form-options a">Sign up</a></p>
    </main>
</body>

</html>