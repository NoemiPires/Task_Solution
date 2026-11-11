<?php
session_start();

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('conexao.php');

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $usuario = R::findOne(
        'usuarios',
        'email = ?',
        [$email]
    );

    //confimar se encontrou o utilizador
    if ($usuario && password_verify($password, $usuario->password)) {
        $_SESSION['usuario_id'] = $usuario->id;
        header('Location: index.php');
        exit;
    } else {
        $erro = "Invalid email or password.";
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Styles/initialStyle.css">
</head>

<body>
    <main class="form-card">
        <form action="" method="POST" class="form-options">
            <label for="username">Name:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <button type="submit" class="btn">Enter</button>
            <br>

            <?php if (!empty($erro)): ?>
                <p class="error"><?php echo $erro; ?></p>
            <?php endif; ?>

            <p>Don't have an account? <a href="signup.php" class="form-options a">Sign up</a></p>
    </main>
</body>

</html>