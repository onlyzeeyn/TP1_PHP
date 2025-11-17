<?php
function double_boucle($n) {
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo $i;
        }
        echo "\n";
    }
}

// Test avec 5
double_boucle(5);
?>
