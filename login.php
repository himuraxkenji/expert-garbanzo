<?php

    session_start();

    if(isset($_SESSION['user_id'])){
        header('Location: /php-login');
    }

    require 'database.php';

    if(isset($_POST['email']) && isset($_POST['password'])){
        $sentence = 'SELECT id, email, pass FROM users WHERE email=:email';
        $records = $connection->prepare($sentence);
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (count($results) > 0 && password_verify($_POST['password'], $results['pass'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /php-login');
        }else{
            $message = 'Sorry, those credentials do not match';
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require('partials/header.php')?>
    <h1>Login</h1>
    <span>or <a href="signup.php">Signup</a></span>

    <?php if(isset($message)) : ?>
    <p> <?= $message ?> </p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Send">
    </form>
</body>
</html>