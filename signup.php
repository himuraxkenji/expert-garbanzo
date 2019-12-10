<?php
    require 'database.php';

    $message = '';

    if(isset($_POST['email']) && isset($_POST['password'])){
        $sentence = "INSERT INTO users (email, pass) VALUE (:email, :password)";
        $statement = $connection->prepare($sentence);
        $statement->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $statement->bindParam(':password', $password);

        if($statement->execute()){
            $message = 'Successfully created new user';
        }else{
            $message = 'Sorry there must have been a issue creating your account';
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require('partials/header.php')?>

    <?php
        if(!empty($message)){
    ?>

    <p><?= $message ?></p>

    <?php }  ?>


    <h1>Signup</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" value="Send">
    </form>
</body>
</html>