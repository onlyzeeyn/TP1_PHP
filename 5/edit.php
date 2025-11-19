<?php
include "config.php";

if (!isset($_GET['id'])) {
    die("ID manquant");
}

$id = (int)$_GET['id'];

$sth = $dbh->prepare("SELECT * FROM `100` WHERE id = :id");
$sth->execute(['id' => $id]);
$data = $sth->fetch();

if (!$data) {
    die("Coureur introuvable");
}

$coursesStmt = $dbh->query("SELECT DISTINCT course FROM `100` ORDER BY course ASC");
$courses = $coursesStmt->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!preg_match('/^[A-Za-z]{3}$/', $_POST['pays'])) {
        die("Le pays doit faire 3 lettres.");
    }

    if (!is_numeric($_POST['temps'])) {
        die("Temps invalide.");
    }

    $update = $dbh->prepare("
        UPDATE `100`
        SET nom=:nom, pays=:pays, course=:course, temps=:temps
        WHERE id=:id
    ");

    $update->execute([
        'nom'   => $_POST['nom'],
        'pays'  => strtoupper($_POST['pays']),
        'course'=> $_POST['course'],
        'temps' => $_POST['temps'],
        'id'    => $id
    ]);

    header("Location: sql.php");
    exit;
}
?>

<form method="post">
    Nom: <input type="text" name="nom" value="<?= $data['nom'] ?>" required><br><br>
    Pays: <input type="text" name="pays" maxlength="3" value="<?= $data['pays'] ?>" required><br><br>

    Course:
    <select name="course">
        <?php foreach ($courses as $c): ?>
            <option value="<?= $c ?>" <?= ($c === $data['course']) ? 'selected' : '' ?>>
                <?= $c ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Temps: <input type="number" step="0.01" name="temps" value="<?= $data['temps'] ?>" required><br><br>

    <button type="submit">Enregistrer</button>
</form>

<a href="sql.php">Retour</a>

