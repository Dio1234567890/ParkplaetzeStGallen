<?php
// Einbinden des Extract-Skripts
include 'extract.php';

// Funktion zur Bereinigung und Transformation der Daten
function transformData($data) {
    // Prüfen, ob Daten vorhanden sind
    if (empty($data) || !isset($data['records'])) {
        echo "Keine Daten zum Transformieren.";
        return [];
    }

    $transformedData = [];

    // Durchlaufen aller Datensätze
    foreach ($data['records'] as $record) {
        if (isset($record['fields'])) {
            $fields = $record['fields'];

            // Bereinigen und Transformieren der Daten
            $transformedRecord = [
                'phid' => $fields['phid'] ?? 'N/A',
                'phname' => $fields['phname'] ?? 'Unbekannt',
                'phstate' => $fields['phstate'] ?? 'Unbekannt',
                'shortmax' => intval($fields['shortmax'] ?? 0),
                'shortfree' => intval($fields['shortfree'] ?? 0),
                'shortoccupied' => intval($fields['shortoccupied'] ?? 0),
                'belegung_prozent' => floatval($fields['belegung_prozent'] ?? 0),
                'lon' => floatval($fields['standort']['lon'] ?? 0),
                'lat' => floatval($fields['standort']['lat'] ?? 0),
                'zeitpunkt' => date('Y-m-d H:i:s', strtotime($fields['zeitpunkt'] ?? 'now'))
            ];

            // Hinzufügen zum transformierten Array
            $transformedData[] = $transformedRecord;
        }
    }

    return $transformedData;
}

// Ausführen der Transformation
$transformedData = transformData($data);

// Optional: Ausgabe der transformierten Daten zur Überprüfung
echo "Transformierte Daten:\n";
echo json_encode($transformedData, JSON_PRETTY_PRINT);

?>
