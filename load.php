<?php
// Einbinden der Konfigurationsdatei und des Transform-Skripts
include 'config.php';
include 'transform.php';

// Datenbankverbindung herstellen
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// SQL-Vorbereitung für das Einfügen der Daten
$sql = "INSERT INTO ParkingData (phid, phname, phstate, shortmax, shortfree, shortoccupied, belegung_prozent, lon, lat, zeitpunkt) 
        VALUES (:phid, :phname, :phstate, :shortmax, :shortfree, :shortoccupied, :belegung_prozent, :lon, :lat, :zeitpunkt)
        ON DUPLICATE KEY UPDATE 
            phname = VALUES(phname),
            phstate = VALUES(phstate),
            shortmax = VALUES(shortmax),
            shortfree = VALUES(shortfree),
            shortoccupied = VALUES(shortoccupied),
            belegung_prozent = VALUES(belegung_prozent),
            lon = VALUES(lon),
            lat = VALUES(lat),
            zeitpunkt = VALUES(zeitpunkt)";

$stmt = $pdo->prepare($sql);

// Daten in die Datenbank einfügen
foreach ($transformedData as $data) {
    $stmt->execute([
        ':phid' => $data['phid'],
        ':phname' => $data['phname'],
        ':phstate' => $data['phstate'],
        ':shortmax' => $data['shortmax'],
        ':shortfree' => $data['shortfree'],
        ':shortoccupied' => $data['shortoccupied'],
        ':belegung_prozent' => $data['belegung_prozent'],
        ':lon' => $data['lon'],
        ':lat' => $data['lat'],
        ':zeitpunkt' => $data['zeitpunkt']
    ]);
}

echo "Daten erfolgreich in die Datenbank geladen.";

?>
