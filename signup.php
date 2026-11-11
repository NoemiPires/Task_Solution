<?php 
//inciar sessão
session_start();
//verificaer se a pagina recebeu os dados do formulario
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once('conexao.php');

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    $usuario = R::dispense('usuarios');
    $usuario->username = $username;
    $usuario->password = password_hash( $password, PASSWORD_DEFAULT);
    $usuario->email = $email;
    R::store($usuario);

    header('Location: login.php'); exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="Styles/initialStyle.css">
</head>

<body>
    <main class="form-card">
        <form action="signup.php" method="POST" class="form-options">
            <label for="username">Name:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" name="confirm-password" id="confirm-password" required>
            <br>
            <button type="submit" class="btn">Enter</button>
            <br>
            <p>You have an account? <a href="login.php" class="form-options a">Login</a></p>
    </main>
</body>

</html>