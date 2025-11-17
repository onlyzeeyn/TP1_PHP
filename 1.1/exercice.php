<?php
function niveau_scolaire($age) {
    if ($age < 3) {
        return "creche";
    } elseif ($age < 6) {
        return "maternelle";
    } elseif ($age < 11) {
        return "primaire";
    } elseif ($age < 16) {
        return "college";
    } elseif ($age < 18) {
        return "lycee";
    } else {
        return "";
    }
}

// Tests
$ages = [2, 4, 8, 13, 17, 20];
foreach ($ages as $age) {
    echo "Age: $age -> " . niveau_scolaire($age) . "\n";
}
?>
