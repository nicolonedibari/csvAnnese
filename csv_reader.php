<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bellissima tabella</title>
</head>
<body>
<?php
$path = "data/users.csv";

// Se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Prendo i dati del form
    $newRow = [];
    foreach ($_POST as $campo => $valore) {
        $newRow[] = trim($valore);
    }

    // Aggiungo la nuova riga al CSV
    if (($handle = fopen($path, "a")) !== false) {
        fputcsv($handle, $newRow);
        fclose($handle);
    }
}

// Leggo il file CSV per mostrare la tabella
if (($handle = fopen($path, "r")) !== false) {
    echo "<table>";
    $intestazioni = fgetcsv($handle);

    // Stampo l'intestazione se esiste
    if ($intestazioni) {
        echo "<tr>";
        foreach ($intestazioni as $colonna) {
            echo "<th>" . htmlspecialchars($colonna) . "</th>";
        }
        echo "</tr>";
    }

    // Stampo le righe dei dati
    while (($riga = fgetcsv($handle)) !== false) {
        echo "<tr>";
        foreach ($riga as $campo) {
            echo "<td>" . htmlspecialchars($campo) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    fclose($handle);
}

// Ora mostriamo il form per aggiungere nuovi utenti
if (!empty($intestazioni)) {
    echo '<form method="POST">';
    foreach ($intestazioni as $colonna) {
        echo '<input type="text" name="' . htmlspecialchars($colonna) . '" placeholder="' . htmlspecialchars($colonna) . '">';
    }
    echo '<br><button type="submit">Aggiungi riga</button>';
    echo '</form>';
}
?>
</body>
</html>
