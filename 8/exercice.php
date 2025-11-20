<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
            background-color: rgb(195, 195, 195);
            display:inline-block; padding:5px 15px;
            border-radius:10px
        }
        form{
            background-color: rgba(225, 225, 225, 1);
            padding: 10px 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Inscription</h1>
    <form method="post">
        <label>Username : </label>
        <input type="text" name="username"><br/>

        <label>Password : </label>
        <input type="password" name="password"><br/>

        <input type="submit" value="Valider" name="register">
    </form>

    <hr>

    <h1>Connection</h1>
    <form method="post">
        <label>Username : </label>
        <input type="text" name="username"><br/>

        <label>Password : </label>
        <input type="password" name="password"><br/>

        <input type="submit" value="Valider" name="connect">
    </form>

    <hr>
</body>
</html>

<?php

include 'config.php';
session_start();

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == '') {
        echo "<p style='color:red; font-weight:bold;'>Le champ username est vide.</p>";
    } elseif ($password == '') {
        echo "<p style='color:red; font-weight:bold;'>Le champ password est vide.</p>";
    } else {
        $stmt = $dbh->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $userExists = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userExists) {
            echo "<p style='color:red; font-weight:bold;'>Ce nom d'utilisateur est déjà pris.</p>";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sth = $dbh->prepare('INSERT INTO user (`username`, `password`) VALUES (:username, :password);');
            $sth->execute([
                'username' => $username,
                'password' => $hash,
            ]);
            echo "<p style='color:green; font-weight:bold;'>Votre inscription est valide !</p>";
        }
    }
}

if (isset($_POST['connect'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == '') {
        echo "<p style='color:red; font-weight:bold;'>Le champ username est vide.</p>";
    } elseif ($password == '') {
        echo "<p style='color:red; font-weight:bold;'>Le champ password est vide.</p>";
    } else {
        $stmt = $dbh->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "<p style='color:red; font-weight:bold;'>Nom d'utilisateur inexistant.</p>";
        } elseif (!password_verify($password, $user['password'])) {
            echo "<p style='color:red; font-weight:bold;'>Mot de passe invalide.</p>";
        } else {
            $_SESSION['username'] = $username;
            echo "<p style='color:green; font-weight:bold;'>Connexion réussie !</p>";
        }
    }
}

?>
