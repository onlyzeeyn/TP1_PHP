<?php
$eleves = [
    ["nom" => "Alice", "notes" => [15, 14, 16]],
    ["nom" => "Bob", "notes" => [12, 10, 11]],
    ["nom" => "Claire", "notes" => [18, 17, 16]]
];

foreach ($eleves as $eleve) {
    $nom = $eleve["nom"];
    $notes = $eleve["notes"];
    
    // Calcul de la moyenne
    $somme = array_sum($notes);
    $nombre_notes = count($notes);
    $moyenne = $somme / $nombre_notes;
    
    echo "Nom : $nom, Moyenne : $moyenne<br>";
}
?>