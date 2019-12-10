<?php
    $server = 'localhost';
    $username = 'root';
    $password = 'Ad46b36ff';
    $database = 'php_login';

    try{
        $connection = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    }catch (PDOException $error){
        die('Connection Failed: '.$error->getMessage());
    }

?>

