<?php
include 'config.php';

// Überprüfen, ob ein Parkhaus ausgewählt wurde
if(isset($_GET['parking'])) {
    $selectedParking = $_GET['parking'];
} else {
    $selectedParking = ''; // Standardwert, wenn kein Parkhaus ausgewählt ist
}

// Datenbankverbindung herstellen
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// SQL-Abfrage vorbereiten, um die Auslastungsdaten für das ausgewählte Parkhaus zu erhalten
$sql = "SELECT zeitpunkt, belegung_prozent FROM ParkingData WHERE phstate != 'nicht verfügbar'";
if ($selectedParking !== '') {
    $sql .= " AND phid = :parking";
}

$stmt = $pdo->prepare($sql);

// Falls ein Parkhaus ausgewählt wurde, füge den Parameter hinzu
if ($selectedParking !== '') {
    $stmt->bindParam(':parking', $selectedParking, PDO::PARAM_STR);
}

// SQL-Abfrage ausführen
$stmt->execute();

// Daten in einem Array sammeln
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ergebnisse ausgeben oder für weitere Verarbeitung bereitstellen
echo json_encode($results);
?>
