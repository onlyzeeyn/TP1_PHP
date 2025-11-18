<?php
// Le fichier contenant les contacts
$fichier = "contact.txt";

// Nouveaux contacts à ajouter
$nouveaux_contacts = ["Alice Dupont", "John Doe", "Jean Martin"];

// Vérifier si le fichier existe
if (file_exists($fichier)) {
    // Lire tous les contacts existants dans un tableau
    $contacts_existants = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Parcourir les nouveaux contacts
    foreach ($nouveaux_contacts as $contact) {
        // Ajouter le contact seulement s'il n'existe pas déjà
        if (!in_array($contact, $contacts_existants)) {
            $contacts_existants[] = $contact;
        }
    }

    // Écrire le tableau mis à jour dans le fichier
    file_put_contents($fichier, implode(PHP_EOL, $contacts_existants) . PHP_EOL);

    echo "Les contacts ont été mis à jour avec succès !";
} else {
    echo "Le fichier n'existe pas.";
}
?>
