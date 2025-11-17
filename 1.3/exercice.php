<?php
function double_boucle($n) {
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo $i;
        }
        echo "<br>"; // <--- saute la ligne dans le navigateur
    }
}

// Test avec 5
double_boucle(5);
?>