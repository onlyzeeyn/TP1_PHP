<?php
function my_str_contains($haystack, $needle) {
    $len_haystack = strlen($haystack);
    $len_needle = strlen($needle);

    // Si la chaîne recherchée est plus longue que la cible, impossible
    if ($len_needle > $len_haystack) {
        return false;
    }

    // Parcours de la chaîne cible
    for ($i = 0; $i <= $len_haystack - $len_needle; $i++) {
        $found = true;
        // Vérification caractère par caractère
        for ($j = 0; $j < $len_needle; $j++) {
            if (!isset($haystack[$i + $j]) || $haystack[$i + $j] !== $needle[$j]) {
                $found = false;
                break;
            }
        }
        if ($found) {
            return true;
        }
    }

    return false;
}

// Les testes
var_dump(my_str_contains("hello", "hello world")); // FALSE
var_dump(my_str_contains("hello world", "hello")); // TRUE
var_dump(my_str_contains("the hello the world", "the w")); // TRUE
var_dump(my_str_contains("hello the world", "world")); // TRUE
var_dump(my_str_contains("hello the world", "world is big")); // FALSE
?>
