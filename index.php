<?php
    session_start();
    require 'database.php';

    if(isset($_SESSION['user_id'])){
        $records = $connection->prepare('SELECT id, email, pass FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0 ){
            $user = $results;
        }
    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to task app</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require('partials/header.php')?>

    <?php if (isset($user)): ?>
        <br>Welcome. <?= $user['email'] ?>
        <br>You are Successfully logged In
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <h1>Login o Signup</h1>
        <a href="login.php">Login</a> or
        <a href="signup.php">Signup</a>
    <?php endif; ?>

</body>
</html>