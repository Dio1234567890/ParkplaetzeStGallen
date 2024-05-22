<?php
// API-URL
$url = 'https://daten.stadt.sg.ch/api/records/1.0/search/?dataset=freie-parkplatze-in-der-stadt-stgallen-pls&rows=100';

// Initialisieren von cURL
$curl = curl_init();

// cURL-Optionen setzen
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);

// API-Abfrage ausführen
$response = curl_exec($curl);

// Fehlerbehandlung
if (curl_errno($curl)) {
    echo 'cURL-Fehler: ' . curl_error($curl);
    curl_close($curl);
    exit;
}

// cURL beenden
curl_close($curl);

// Antwort decodieren
$data = json_decode($response, true);

// Prüfen, ob Daten erfolgreich abgerufen wurden
if ($data === null || !isset($data['records'])) {
    echo "Fehler beim Decodieren der API-Antwort oder keine Datensätze gefunden.";
    exit;
}

// Ausgabe der extrahierten Daten in einem freundlichen Textformat
echo "Extrahierte Daten:\n";
foreach ($data['records'] as $record) {
    $fields = $record['fields'];
    // Sicherstellen, dass die Standortdaten vorhanden sind, bevor darauf zugegriffen wird
    $standort = isset($fields['standort']) ? $fields['standort'] : null;
    echo "Parkplatz ID: " . $fields['phid'] . "\n";
    echo "Name: " . $fields['phname'] . "\n";
    echo "Status: " . $fields['phstate'] . "\n";
    echo "Maximale Plätze: " . $fields['shortmax'] . "\n";
    echo "Freie Plätze: " . $fields['shortfree'] . "\n";
    echo "Belegte Plätze: " . $fields['shortoccupied'] . "\n";
    echo "Auslastung (%): " . (isset($fields['belegung_prozent']) ? $fields['belegung_prozent'] : "N/A") . "\n";
    echo "Latitude: " . ($standort && isset($standort['lat']) ? $standort['lat'] : 'N/A') . "\n";
    echo "Longitude: " . ($standort && isset($standort['lon']) ? $standort['lon'] : 'N/A') . "\n";
    echo "Zeitpunkt: " . date('Y-m-d H:i:s', strtotime($fields['zeitpunkt'])) . "\n";
    echo "-----------------------\n";
}
echo "<br><br><br><br><br>";
?>
