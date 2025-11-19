<?php
include "config.php";

$sort = "nom"; 
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}

$order = "desc"; 
if (isset($_GET['order'])) {
    $order = $_GET['order'];
}

$limit = 10;
$page = 1;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];
}
$offset = ($page - 1) * $limit;

echo '<br>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sth = $dbh->prepare('INSERT INTO `100` (`nom`, `pays`, `course`, `temps`) VALUES (:nom, :pays, :course, :temps)');
    $sth->execute([
        'nom' => $_POST['nom'],
        'pays' => strtoupper($_POST['pays']),
        'course' => $_POST['course'],
        'temps' => $_POST['temps']
    ]);
}

$coursesStmt = $dbh->query("SELECT DISTINCT course FROM `100` ORDER BY course ASC");
$courses = $coursesStmt->fetchAll(PDO::FETCH_COLUMN);

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$totalStmt = $dbh->prepare('SELECT COUNT(*) FROM `100` WHERE nom LIKE :s OR pays LIKE :s OR course LIKE :s');
$totalStmt->bindValue(':s', "%$search%", PDO::PARAM_STR);
$totalStmt->execute();
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $limit);

$sql = "SELECT * FROM `100` 
        WHERE nom LIKE :search OR pays LIKE :search OR course LIKE :search
        ORDER BY $sort $order 
        LIMIT :limit OFFSET :offset";

$sth = $dbh->prepare($sql);
$sth->bindValue(':search', "%$search%", PDO::PARAM_STR);
$sth->bindValue(':limit', $limit, PDO::PARAM_INT);
$sth->bindValue(':offset', $offset, PDO::PARAM_INT);
$sth->execute();
$data = $sth->fetchAll();

$allStmt = $dbh->query("SELECT id, course, temps FROM `100` ORDER BY course ASC, temps ASC");
$allData = $allStmt->fetchAll(PDO::FETCH_ASSOC);

$classements = [];
$pos = 1;

foreach ($allData as $r) {
    if (!isset($classements[$r['course']])) {
        $classements[$r['course']] = [];
        $pos = 1;
    }
    $classements[$r['course']][$r['id']] = $pos;
    $pos++;
}

echo '<style>
a{font-size:20px;font-weight: 900;}
.active-sort {color: red;font-weight: bold;text-decoration: none; }
th a{ text-decoration: none; }
.pagination a { margin: 0 5px; text-decoration: none;font-weight: bold;}
.pagination .current{ color: red; }
</style>';

echo '
<form method="post" style="margin-bottom:20px;">
    Nom: <input type="text" name="nom" required >
    Pays (3 lettres): <input type="text" name="pays" maxlength="3" required>

    Course:
    <select name="course" required>';
        foreach ($courses as $c) {
            echo "<option value=\"$c\">$c</option>";
        }
echo '
    </select>

    Temps: <input type="number" step="0.01" name="temps" required>
    <button type="submit">Ajouter</button>
</form>
';

echo '
<form method="get" style="margin-bottom:20px;">
    <input type="text" name="search" placeholder="Rechercher..." value="'.htmlspecialchars($search).'">
    <button type="submit">Rechercher</button>
</form>
';

echo '<hr>';

echo "<table>
    <thead>
        <tr>
            <th>Nom 
                <a href=\"?sort=nom&order=desc&search=$search\" ".($sort=='nom' && $order=='desc'?"class='active-sort'":"")."> ↓ </a> 
                <a href=\"?sort=nom&order=asc&search=$search\" ".($sort=='nom' && $order=='asc'?"class='active-sort'":"")."> ↑ </a>
            </th>
            
            <th>Pays
                <a href=\"?sort=pays&order=desc&search=$search\" ".($sort=='pays' && $order=='desc'?"class='active-sort'":"")."> ↓ </a>
                <a href=\"?sort=pays&order=asc&search=$search\" ".($sort=='pays' && $order=='asc'?"class='active-sort'":"")."> ↑ </a>
            </th>

            <th>Course 
                <a href=\"?sort=course&order=desc&search=$search\" ".($sort=='course' && $order=='desc'?"class='active-sort'":"")."> ↓ </a>
                <a href=\"?sort=course&order=asc&search=$search\" ".($sort=='course' && $order=='asc'?"class='active-sort'":"")."> ↑ </a>
            </th>

            <th>Temps
                <a href=\"?sort=temps&order=desc&search=$search\" ".($sort=='temps' && $order=='desc'?"class='active-sort'":"")."> ↓ </a>
                <a href=\"?sort=temps&order=asc&search=$search\" ".($sort=='temps' && $order=='asc'?"class='active-sort'":"")."> ↑ </a>
            </th>

            <th>Classement</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>";

foreach ($data as $value) {
    echo "<tr>
        <td>".$value["nom"]."</td>
        <td>".$value["pays"]."</td>
        <td>".$value["course"]."</td>
        <td>".$value["temps"]."</td>
        <td>".$classements[$value["course"]][$value["id"]]."</td>
        <td><a href='edit.php?id=".$value["id"]."'>Modifier</a></td>
    </tr>";
}

echo "</tbody></table>";

echo '<div class="pagination">';
for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $page) {
        echo "<span class='current'>$i</span>";
    } else {
        echo "<a href=\"?page=$i&sort=$sort&order=$order&search=$search\">$i</a>";
    }
}
echo '</div>';

$dbh = null;
?>


