<?php

function my_str_contains(string $haystack, string $needle)
{
    $lenHay = strlen($haystack);
    $lenNeedle = strlen($needle);

    if ($lenNeedle === 0) {
        return true;
    }

    for ($i = 0; $i <= $lenHay - $lenNeedle; $i++) {
        $match = true;

        for ($j = 0; $j < $lenNeedle; $j++) {
            if (!isset($haystack[$i + $j]) || $haystack[$i + $j] !== $needle[$j]) {
                $match = false;
                break;
            }
        }

        if ($match) {
            return true;
        }
    }

    return false;
}

// Exemples d'utilisation :
echo my_str_contains("Hello world", "world") ? "true" : "false"; 
// Résultat attendu : true

echo "\n";

echo my_str_contains("Bonjour", "xyz") ? "true" : "false"; 

?>
