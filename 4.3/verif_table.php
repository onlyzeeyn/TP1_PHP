<?php

// Lire le fichier
$lines = file('table.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Supprimer les espaces multiples et transformer en tableau
$table = [];
foreach ($lines as $line) {
    // On sépare par espaces (plusieurs espaces possibles)
    $numbers = preg_split('/\s+/', trim($line));
    $table[] = $numbers;
}

// Les erreurs seront stockées ici
$erreurs = [];

// On commence à vérifier à partir de la 2e ligne et 2e colonne
// car la 1ère ligne/colonne est l'en-tête
for ($i = 1; $i < count($table); $i++) {
    for ($j = 1; $j < count($table[$i]); $j++) {
        $valeur = intval($table[$i][$j]);
        $ligne = intval($table[$i][0]);
        $colonne = intval($table[0][$j]);
        $resultat_attendu = $ligne * $colonne;

        if ($valeur !== $resultat_attendu) {
            $erreurs[] = "{$ligne}x{$colonne}";
        }
    }
}

// Affichage
if (!empty($erreurs)) {
    echo "Les erreurs sont : " . implode(', ', $erreurs);
} else {
    echo "Aucune erreur dans la table de multiplication.";
}

?>
