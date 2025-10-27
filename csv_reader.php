<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bellissima tabella</title>
</head>
<body>
    <?php
    $path = "data/users.csv";
    $handle = fopen($path, "r");

    //Qui renderizzo tag di apertura tabella
    echo "<table>";
        while (($riga = fgetcsv($handle)) !== false) {
            //Qui renderizzo il tag di apertura della riga della tabella
            echo "<tr>";
            foreach ($riga as $campo) {
                //Qui renderizzo il tag di apertura, il contenuto e il tag di chiusura della cella
                echo "<td>" . htmlspecialchars($campo) . "</td>";
            }
            echo "</tr>";
        }
    echo "</table>";
    fclose($handle);
?>
</body>
</html>