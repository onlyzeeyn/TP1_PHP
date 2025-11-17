<?php

function calcMoy(array $numbers)
{
    $count = count($numbers);
    if ($count === 0) {
        return 0;
    }

    $sum = 0;
    for ($i = 0; $i < $count; $i++) {
        $sum += $numbers[$i];
    }

    return $sum / $count;
}

// Exemple d'utilisation :
$notes = [12, 15, 19];
echo "Moyenne : " . calcMoy($notes); 

?>
