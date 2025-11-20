<?php
session_start(); 

if (isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
}

if (isset($_GET['delete'])) {
    unset($_SESSION['username']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>document</title>
</head>
<body>

<?php
if (!isset($_SESSION['username'])) {
    ?>
    <form method="POST">
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" required>
        <button type="submit">Valider</button>
    </form>
    <?php

} else {
    echo "<h2>Bienvenue, " . ($_SESSION['username']) . " !</h2>";
    
    echo '<a href="http://localhost/php/exercice.php?delete=1">Réinitialiser</a>';
}

?>


</body>
</html>
