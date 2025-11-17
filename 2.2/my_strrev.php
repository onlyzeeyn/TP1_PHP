<?php

function my_strrev(string $str)
{
    $length = strlen($str);
    $reversed = "";

    for ($i = $length - 1; $i >= 0; $i--) {
        if (isset($str[$i])) {
            $reversed .= $str[$i];
        }
    }

    return $reversed;
}

// Exemple d'utilisation :
echo my_strrev("Bonjour");

?>
