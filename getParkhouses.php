<?php
include 'config.php';

header('Content-Type: application/json'); // Setzen des Content-Type-Headers

// Datenbankverbindung herstellen
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    http_response_code(500); // Setzen eines HTTP-Fehlerstatus
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
    exit; // Beenden des Skripts nach Fehler
}

// SQL-Abfrage vorbereiten, um eindeutige Parkhäuser zu erhalten
$sql = "SELECT DISTINCT phid, phname FROM ParkingData WHERE phstate != 'nicht verfügbar'";
$stmt = $pdo->prepare($sql);

// SQL-Abfrage ausführen und Fehlerbehandlung
if (!$stmt->execute()) {
    http_response_code(500); // Setzen eines HTTP-Fehlerstatus
    echo json_encode(["error" => "Error executing the query"]);
    exit; // Beenden des Skripts nach Fehler
}

// Daten in einem Array sammeln
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($results)) {
    http_response_code(404); // Setzen eines HTTP-Fehlerstatus, falls keine Daten gefunden
    echo json_encode(["error" => "No data found"]);
    exit; // Beenden des Skripts, falls keine Daten gefunden
}

// Ergebnisse ausgeben
echo json_encode($results);
?>
