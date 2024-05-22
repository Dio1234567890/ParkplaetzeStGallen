<?php
include 'config.php';

// Überprüfen, ob ein Zeitwert übergeben wurde
if(isset($_GET['time'])) {
    $selectedTime = $_GET['time']; // Zeitwert aus GET-Variable erhalten
} else {
    die("Bitte geben Sie eine Zeit ein.");
}

// Datenbankverbindung herstellen
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// SQL-Abfrage vorbereiten, um die am wenigsten belegten Parkhäuser basierend auf der Zeit abzurufen
$sql = "SELECT phname, MIN(belegung_prozent) as least_busy_percent 
        FROM ParkingData 
        WHERE zeitpunkt LIKE CONCAT('%', SUBSTRING(:selectedTime, 1, 2), ':%') 
        GROUP BY phname";

$stmt = $pdo->prepare($sql);

// SQL-Abfrage ausführen
$stmt->execute([
    ':selectedTime' => $selectedTime
]);

// Daten in einem Array sammeln
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ergebnisse als JSON ausgeben
echo json_encode($results);
?>
