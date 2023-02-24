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

function logUser($email, $password)
{
    $connexion = connectDb();
    $sql = 'SELECT * FROM users WHERE email = "' . $email . '" AND password = "' .$password . '"';
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function checkLogUser($email)
{
    $connexion = connectDb();
    $sql = 'SELECT password FROM users WHERE email = "' . $email . '" LIMIT 1';
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getUser($id) {
    $connexion = connectDb();
    $sql = $connexion->prepare('SELECT * FROM users WHERE id =  ?' );
    $sql->bindParam(1,$id);
    $sql->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


function saveUser($username, $email, $password) {
    $connexion = connectDb();
	$passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users(username,email,password) VALUES("'.htmlentities($email).'","'.htmlentities($username).'","'.$passwordHash.'")';
    $stmt = $connexion->prepare($sql);

    return $stmt->execute();
}

