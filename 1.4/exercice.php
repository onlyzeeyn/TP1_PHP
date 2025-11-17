<?php
// Méthode 1 : Algorithme d'Euclide classique (soustraction)
function pgcd_1($a, $b) {
    while ($a != $b) {
        if ($a > $b) {
            $a = $a - $b;
        } else {
            $b = $b - $a;
        }
    }
    return $a;
}

// Méthode 2 : Algorithme d'Euclide avec modulo
function pgcd_2($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

// Méthode 3 : Algorithme récursif avec modulo
function pgcd_3($a, $b) {
    if ($b == 0) {
        return $a;
    } else {
        return pgcd_3($b, $a % $b);
    }
}

// Tests
$a = 48;
$b = 18;
echo "PGCD de $a et $b :\n";
echo "Méthode 1 : " . pgcd_1($a, $b) . "\n";
echo "Méthode 2 : " . pgcd_2($a, $b) . "\n";
echo "Méthode 3 : " . pgcd_3($a, $b) . "\n";
?>
