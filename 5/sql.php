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

$sth = $dbh->prepare('SELECT * FROM `100` ORDER BY ' . $sort . ' ' . $order);
$sth->execute();

$data = $sth -> fetchAll();

echo '<style>
a{
    font-size:20px;
    font-weight: 900;
}
.active-sort {
    color: red;
    font-weight: bold;
    text-decoration: none;
}
th a{
    text-decoration: none;
}
</style>';

    echo "<table>
        <thead>
            <tr>
                <th>Nom 
                    <a href=\"./sql.php?sort=nom\" " . ($sort == 'nom' && $order == 'desc'?"class=\"active-sort\"":"")."> ↓ </a> 
                    <a href=\"./sql.php?sort=nom&order=asc\" " . ($sort == 'nom' && $order == 'asc'?"class=\"active-sort\"":"")."> ↑ </a>
                </th>
                
                <th>Pays
                    <a href=\"./sql.php?sort=pays\" " . ($sort == 'pays' && $order == 'desc'?"class=\"active-sort\"":"")."> ↓ </a>
                    <a href=\"./sql.php?sort=pays&order=asc\" " . ($sort == 'pays' && $order == 'asc'?"class=\"active-sort\"":"")."> ↑ </a>
                </th>

                <th>Course 
                    <a href=\"./sql.php?sort=course\" " . ($sort == 'course' && $order == 'desc'?"class=\"active-sort\"":"")."> ↓ </a>
                    <a href=\"./sql.php?sort=course&order=asc\" " . ($sort == 'course' && $order == 'asc'?"class=\"active-sort\"":"")."> ↑ </a>
                </th>

                <th>Temps
                    <a href=\"./sql.php?sort=temps\" " . ($sort == 'temps' && $order == 'desc'?"class=\"active-sort\"":"")."> ↓ </a>
                    <a href=\"./sql.php?sort=Temps&order=asc\" " . ($sort == 'temps' && $order == 'asc'?"class=\"active-sort\"":"")."> ↑ </a>
                </th>
            </tr>
        </thead>
        <tbody>";

    foreach ($data as $value) {
        echo "<tr>
            <td>" . $value["nom"] . "</td>
            <td>" . $value["pays"] . "</td>
            <td>" . $value["course"] . "</td>
            <td>" . $value["temps"] . "</td>
        </tr>";
    }

    echo "    </tbody>
    </table>";

$mysqlClient = null;
$dbh = null;

?>


