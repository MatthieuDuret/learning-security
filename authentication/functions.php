<?php

function connectDb()
{
    try {
        $conn = new PDO("mysql:host=127.0.0.1;dbname=authentication", 'root', '');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}



function saveUser($username, $email, $password) {
    $connexion = connectDb();
	$passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users(username,email,password) VALUES("'.htmlentities($email).'","'.htmlentities($username).'","'.$passwordHash.'")';
    $stmt = $connexion->prepare($sql);

    return $stmt->execute();
}

