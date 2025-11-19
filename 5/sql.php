<?php
include "config.php";

//requetes
$query = $dbh -> prepare(query:"Select * From `100`;");
$query -> execute();

$data = $query -> fetchAll();


    echo "<table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Pays</th>
                <th>Course</th>
                <th>Temps</th>
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


var_dump($data);

//Fermeture de la connexion
$mysqlClient = null;
$dbh = null;

?>


